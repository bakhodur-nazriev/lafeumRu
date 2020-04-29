<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quote;
use App\Author;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotesController extends Controller
{
    public function index()
    {
        $countOfFavoritesQuotes = Favorite::where('favoriteable_type', 'App\Quote')->count();
        $countOfFavoritesTerms = Favorite::where('favoriteable_type', 'App\Term')->count();
        $countOfFavoritesVideos = Favorite::where('favoriteable_type', 'App\Video')->count();

        $quotes = Quote::with('author', 'categories')->paginate(10);
        $categories = Category::where('type', Quote::class)->get()->toTree()->unique('name');
        return view('/quotes', compact([
                'quotes',
                'categories',
                'countOfFavoritesQuotes',
                'countOfFavoritesVideos',
                'countOfFavoritesTerms'
            ])
        );

    }

    public function get(Request $request)
    {
        $quotesQuery = Quote::with('author', 'categories');
        return $quotesQuery->latest()->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required',
            'body' => 'required',
            'categories' => 'required|array'
        ]);

        $newQuote = Quote::create($request->only(['author_id', 'body']));

        $newQuote->categories()->attach($request->categories);

        return $newQuote->load('author', 'categories');
    }

    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);
        $quote->update($request->all());
        $quote->save();
        return response()->json($quote);
    }

    public function delete($id)
    {
        Quote::destroy($id);
        return response()->json("ok");
    }
}
