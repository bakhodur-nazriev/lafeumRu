<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Term::class);
    }

    public function index()
    {
        $terms = Term::with('categories')->latest()->paginate(10);
        return view('/terms', compact(['terms']));
    }

    public function indexVocabulary()
    {
        $terms = Term::with('post')
            ->where('name', '<>', '')
            ->orderBy('name')
            ->get();

        return view("/vocabulary", compact(["terms"]));
    }

    public function linksSearch(Request $request)
    {
        $keyword = $request->key;

        if(!$keyword) return [];

        $terms = Term::with('post')
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

                if($hasKeyword && !$hasSpecialChars) {
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
        $termsQuery = Term::with('categories', 'knowledge');
        return $termsQuery->latest()->paginate($request->perPage ?: 10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'body' => 'required',
            'categories' => 'required|array',
            'knowledgeAreas' => 'required|array',
            'created_at' => 'required'
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
        $term->post()->delete();
        $term->categories()->detach();
        $term->delete();
    }
}
