<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Term;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Term::class);
    }

    public function index()
    {
        $terms = Term::with('categories')->latest()->paginate(30);
        $categories = Category::where('type', Term::class)->get()->toTree()->unique('name');
        return view('/terms', compact(['terms', 'categories',]));
    }

    public function indexVocabulary()
    {
        $terms = Term::with('post')->where('name','<>', '')->get();
        return view("/vocabulary", compact(["terms"]));
    }

    public function showVocabulary($id)
    {
        $vocabulary = Term::with('categories')->where('id', $id)->first();
        return view("shows.vocabulary", compact(['vocabulary']));
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

        return $term;
    }

    public function destroy(Term $term)
    {
        $term->post()->delete();
        $term->categories()->detach();
        $term->delete();
    }
}
