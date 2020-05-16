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
use Illuminate\Support\Facades\Log;

class QuotesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Quote::class);
    }

    public function index()
    {
        $startTime = microtime(true);

        $quotes = Quote::with('author:id,name,slug', 'categories:id,name,slug')->paginate(10);
        $categories = Category::quote()->get()->toTree()->unique('name');

        $totalMs = (microtime(true) - $startTime) * 1000;

        Log::debug("Categories preparation took: $totalMs ms.");

        return view('/quotes', compact(['quotes', 'categories',]));
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

        $newQuote->post()->create();

        return $newQuote->load('author', 'categories');
    }

    public function update(Quote $quote, Request $request)
    {
        $quote->update($request->all());

        if($request->has('categories')){
            $quote->categories()->sync($request->categories);
        }

        return $quote;
    }

    public function destroy(Quote $quote)
    {
        $quote->post()->delete();
        $quote->categories()->detach();
        $quote->delete();
    }
}
