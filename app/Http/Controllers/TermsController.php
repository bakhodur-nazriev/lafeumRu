<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Term::class);
    }

    public function index()
    {
        $terms = Term::with('categories')->latest()->paginate(30);
        return view('/terms', compact(['terms']));
    }

    public function indexVocabulary()
    {
        $terms = Term::with('post')
            ->vocabulary()
            ->get();

        return view("/vocabulary", compact(["terms"]));
    }

    public function get(Request $request)
    {
        $termsQuery = Term::with('categories', 'knowledge');
        return $termsQuery->latest()->paginate($request->perPage ?: 15);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'body' => 'required',
            'knowledgeAreas' => 'required|array',
            'categories' => 'required|array',
        ]);

        $newTerm = Term::create($request->all());

        $newTerm->knowledge()->attach($request->knowledgeAreas);
        $newTerm->categories()->attach($request->categories);

        $newTerm->post()->create();

        return $newTerm->load(['categories', 'knowledge']);
    }

    public function update(Term $term, Request $request)
    {
        $term->update($request->all());

        if($request->has('categories')){
            $term->categories()->sync($request->categories);
        }

        if($request->has('knowledge')){
            $term->knowledge()->sync($request->knowledge);
        }

        return $term;
    }

    public function destroy(Term $term)
    {
        $term->post()->delete();
        $term->categories()->detach();
        $term->delete();
    }
}
