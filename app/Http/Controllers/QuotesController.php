<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quote;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Quote::class);
    }

    public function index()
    {
        $quotes = Quote::with('author:id,name,slug', 'categories:id,name,slug', 'post')->paginate(30);
        $categories = Category::quote()->get()->toTree()->unique('name');

        return view('/quotes', compact(['quotes', 'categories',]));
    }

    public function get(Request $request)
    {
        $quotesQuery = Quote::with('author', 'categories')->latest();

        return $this->processIndexRequestItems($request, $quotesQuery, 'body');
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required',
            'body' => 'required',
            'categories' => 'required|array',
            'created_at' => 'required'
        ]);

        $newQuote = Quote::create($request->all());

        $newQuote->categories()->attach($request->categories);

        $newQuote->post()->create();

        $newQuote->meta_image = $this->getMetaImage($newQuote);
        $newQuote->save();

        return $newQuote->load('author', 'categories');
    }

    public function update(Quote $quote, Request $request)
    {
        $quote->update($request->all());

        if ($request->has('categories')) {
            $quote->categories()->sync($request->categories);
        }

        $quote->meta_image = $this->getMetaImage($quote);
        $quote->save();

        return $quote;
    }

    public function destroy(Quote $quote)
    {
        $quote->post()->delete();
        $quote->categories()->detach();

        $metaImage = $quote->meta_image;

        $quote->delete();

        if ($metaImage) {
            unlink(public_path($metaImage));
        }
    }
    /**
     * Helpers
     *
     */

    private function getMetaImage(Quote $quote)
    {
        $publicPath = static::META_IMAGES_PATH;

        $publicPath .= $quote->post->id . '.png';

        $path = public_path($publicPath);

        $html = view('layouts.quoteImage', compact('quote'))->render();

        $this->generateMetaImage($html, $path);

        return $publicPath;
    }
}
