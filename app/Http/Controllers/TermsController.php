<?php

namespace App\Http\Controllers;

use App\Category;
use App\Term;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Term::class);
    }

    public function index()
    {
        $countOfFavoritesQuotes = Favorite::where('favoriteable_type', 'App\Quote')->count();
        $countOfFavoritesTerms = Favorite::where('favoriteable_type', 'App\Term')->count();
        $countOfFavoritesVideos = Favorite::where('favoriteable_type', 'App\Video')->count();

        $terms = Term::with('categories')->latest()->paginate(15);
        $categories = Category::where('type', Term::class)->get()->toTree()->unique('name');
        return view('/terms', compact([
                'terms',
                'categories',
                'countOfFavoritesQuotes',
                'countOfFavoritesTerms',
                'countOfFavoritesVideos'
            ])
        );
    }

    public function show(Term $term)
    {
        return view('shows.showTerm', compact('term'));
    }

    public function indexVocabulary()
    {
        $vocabularies = Term::all();
        $categories = Category::where('type', Term::class)->get()->toTree()->unique("name");
        return view("/vocabulary", compact(["vocabularies", "categories"]));
    }

    public function showVocabulary($id)
    {
        $vocabulary = Term::with('categories')->where('id', $id)->first();
        return view("shows.showVocabulary", compact("vocabulary"));
    }

    public function get(Request $request)
    {
        $termsQuery = Term::with('categories');
        return $termsQuery->latest()->get();
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

        return $newTerm->load(['categories', 'knowledge']);
    }

    public function update(Term $term, Request $request)
    {
        $term->update($request->all());

        return $term;
    }

    public function destroy(Term $term)
    {
        $term->delete();
    }
}
