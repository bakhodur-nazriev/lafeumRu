<?php

namespace App\Http\Controllers;

use App\Category;
use App\Knowledge;
use App\Term;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Http\Request;

class KnowledgesController extends Controller
{
    public function index()
    {
        $knowledgeAreas = Knowledge::latest()->get();
        return view('knowledgeArea', compact('knowledgeAreas'));
    }

    public function show($slug)
    {
        $countOfFavoritesQuotes = Favorite::where('favoriteable_type', 'App\Quote')->count();
        $countOfFavoritesTerms = Favorite::where('favoriteable_type', 'App\Term')->count();
        $countOfFavoritesVideos = Favorite::where('favoriteable_type', 'App\Video')->count();

        $knowledgeAreas = Knowledge::all();
        $currentKnowledgeArea = Knowledge::with('terms')->where('slug', $slug)->first();
        return view('shows.showKnowledge', compact([
                'currentKnowledgeArea',
                'knowledgeAreas',
                'countOfFavoritesQuotes',
                'countOfFavoritesVideos',
                'countOfFavoritesTerms'
            ])
        );
    }

    public function get()
    {
        return Knowledge::latest()->get();
    }

    public function store(Request $request)
    {
        return Knowledge::create($request->all());
    }

    public function update(Knowledge $knowledge, Request $request)
    {
        $knowledge->update($request->all());
        
        return $knowledge;
    }

    public function destroy(Knowledge $knowledge)
    {
        $knowledge->delete();
    }
}
