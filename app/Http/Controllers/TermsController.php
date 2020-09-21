<?php

namespace App\Http\Controllers;

use App\Services\RedirectService;
use App\Term;
use Illuminate\Http\Request;

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
        $terms = Term::with('categories', 'termType')
            ->orderBy('term_type_id', 'asc')
            ->published('desc')
            ->paginate(30);
        
        return view('/terms', compact(['terms']));
    }

    public function indexVocabulary()
    {
        $terms = Term::with('post')
            ->where('show_in_vocabulary', true)
            ->orderBy('name')
            ->published()
            ->get();

        return view("/vocabulary", compact(["terms"]));
    }

    public function linksSearch(Request $request)
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
        $termsQuery = Term::with('categories', 'knowledge', 'termType')->byPublishAt();

        return $this->processIndexRequestItems($request, $termsQuery, 'body');
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
        $this->redirectService->registerModelRemoval($term);

        $term->post()->delete();
        $term->categories()->detach();
        $term->delete();
    }
}
