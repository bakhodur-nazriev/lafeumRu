<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quote;
use App\Author;
use App\User;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotesController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Quote::class);
    }

    public function index()
    {
        $quotes = Quote::with('author', 'categories')->paginate(10);
        $categories = Category::quote()->get()->toTree()->unique('name');
        return view('/quotes', compact(['quotes', 'categories',]));
    }

    public function indexByCategory(Request $request)
    {
        // Category::
    }

    public function get(Request $request)
    {
        $quotesQuery = Quote::with('author', 'categories');
        
        return $quotesQuery->latest()->paginate($request->perPage ?: 15);
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required',
            'body' => 'required',
            'categories' => 'required|array'
        ]);

        $newQuote = Quote::create($request->all());

        $newQuote->categories()->attach($request->categories);

        return $newQuote->load('author', 'categories');
    }

    public function update(Quote $quote, Request $request)
    {
        $quote->update($request->all());

        return $quote;
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
    }
}
