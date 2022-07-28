<?php

namespace App\Http\Controllers;

use App\Services\RedirectService;
use App\Category;
use App\Term;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermsController extends Controller
{
    protected $redirectService;

    public function __construct(RedirectService $redirectService)
    {
        $this->authorizeResource(Term::class);
        $this->redirectService = $redirectService;
    }

    public function index()
    {
        $categories = Category::term()->get()->toTree()->unique('name');

        return view('/terms', compact(['categories']));
    }

    public function getTerms(): JsonResponse
    {
        $terms = Term::with([
            "categories",
            "termType",
            "post"
        ])
            ->orderBy("term_type_id")
            ->published("desc")
            ->paginate(20);

        return response()->json(collect($terms));
    }

    public function indexVocabulary()
    {
        $categories = Category::term()->get()->toTree()->unique('name');

        return view("/vocabulary", compact('categories'));
    }

    public function getIndexVocabulary(Request $request): JsonResponse
    {
        if ($request->search != '' || isset($request->search)) {
            return $this->vocabularySearch($request);
        }

        $vocabulary = DB::table('terms')
            ->join('posts', 'posts.postable_id', '=', 'terms.id')
            ->where('posts.postable_type', '=', 'App\\Term')
            ->where('show_in_vocabulary', '=', true)
            ->where('publish_at', '<=', Carbon::now())
            ->where('deleted_at', '=', null)
            ->orderBy('name')
            ->paginate(40);

        return response()->json($vocabulary);
    }

    public function vocabularySearch(Request $request)
    {
        $vocabulary = DB::table('terms')
            ->join('posts', 'posts.postable_id', '=', 'terms.id')
            ->where('posts.postable_type', '=', 'App\\Term')
            ->where('show_in_vocabulary', '=', true)
            ->where('publish_at', '<=', Carbon::now())
            ->where('deleted_at', '=', null)
            ->where('name', 'like', '%' . $request->search . '%')
            ->orderBy('name')
            ->paginate(5);


        return response()->json($vocabulary);
    }


    public function linksSearch(Request $request): JsonResponse
    {
        $keyword = $request->key;

        if (!$keyword) return [];

        $terms = Term::with('post')
            ->published()
            ->whereRaw("body like '%>%$keyword%<%'")
            ->get();

        $links = [];

        foreach ($terms as $term) {
            $termLinks = [];
            preg_match_all("/<a[^>]*>(.*?)<\/a>/", $term->body, $termLinks);

            foreach ($termLinks[1] as $termLink) {

                $termLink = strip_tags($termLink);

                $hasKeyword = strpos($termLink, $keyword) !== false;
                $hasSpecialChars = preg_match('/[.]/', $termLink) === 1;

                if ($hasKeyword && !$hasSpecialChars) {
                    $links[] = [
                        "link" => "/{$term->post->id}",
                        "text" => $termLink
                    ];
                }
            }
        }

        return $links;
    }

    public function get(Request $request)
    {
        $termsQuery = Term::with('categories', 'knowledge', 'termType', 'post')->byPublishAt();
        return $this->processIndexRequestItems($request, $termsQuery, 'body');
    }

    public function getTrashed(Request $request)
    {
        $termsTrashedQuery = Term::with('categories', 'knowledge', 'termType', 'post')
            ->onlyTrashed()
            ->byPublishAt();
        return $this->processIndexRequestItems($request, $termsTrashedQuery, 'body');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'body' => 'required',
            'categories' => 'required|array',
            'knowledgeAreas' => 'required|array',
            'term_type_id' => 'required'
        ]);

        $newTerm = Term::create($request->all());

        $newTerm->knowledge()->attach($request->knowledgeAreas);
        $newTerm->categories()->attach($request->categories);

        $newTerm->post()->create();

        return $newTerm->load('categories', 'knowledge');
    }

    public function update(Term $term, Request $request)
    {
        $term->update($request->all());

        if ($request->has('categories')) {
            $term->categories()->sync($request->categories);
        }

        if ($request->has('knowledge')) {
            $term->knowledge()->sync($request->knowledge);
        }

        $term->save();
        return $term;
    }

    public function destroy(Term $term)
    {
        $term->delete();
    }

    public function restored($id)
    {
        $term = Term::onlyTrashed()->find($id);
        $term->restore();
    }

    public function forceDeleted($id)
    {
        $term = Term::onlyTrashed()->find($id);

        $this->redirectService->registerModelRemoval($term);

        $term->post()->delete();
        $term->categories()->detach();

        $term->forceDelete();
    }
}
