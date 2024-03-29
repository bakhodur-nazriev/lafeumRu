<?php

namespace App\Http\Controllers;

use App\Category;
use App\DailyPost;
use App\Like;
use App\Quote;
use App\Services\RedirectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotesController extends Controller
{
    protected $redirectService;

    public function __construct(RedirectService $redirectService)
    {
        $this->authorizeResource(Quote::class);
        $this->redirectService = $redirectService;
    }

    public function index()
    {
        $categories = Category::quote()->get()->toTree()->unique('name');

        return view("/quotes", compact('categories'));
    }

    public function getDailyQuote(): JsonResponse
    {
        $dailyQuotes = DailyPost::with('quote.author')
            ->orderBy('date', 'desc')
            ->first(['id', 'date', 'quote_id']);

        return response()->json(collect($dailyQuotes));
    }

    public function getQuotes(): JsonResponse
    {
        $quotes = Quote::with([
            "author:id,name,slug",
            "categories:id,name,slug",
            "favorites",
            "likes",
            "post"
        ])
            ->withCount('likes')
            ->published('desc')
            ->has('author')
            ->paginate(20);

        $categories = Category::quote()->get()->toTree()->unique('name');

        return response()->json(collect($quotes, $categories));
    }

    public function get(Request $request)
    {
        $quotesQuery = Quote::with('author', 'categories', 'post')
            ->byPublishAt();

        return $this->processIndexRequestItems($request, $quotesQuery, 'body');
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'author_id' => 'required',
            'categories' => 'required|array',
        ]);

        $newQuote = Quote::create($request->all());

        $newQuote->categories()->attach($request->categories);

        $newQuote->post()->create();

        return $newQuote->load('author', 'categories');
    }

    public function update(Quote $quote, Request $request)
    {
        $quote->update($request->all());

        if ($request->has('categories')) {
            $quote->categories()->sync($request->categories);
        }

        return $quote;
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
    }

    public function getTrashed(Request $request)
    {
        $quotesTrashedQuery = Quote::with('author', 'categories', 'post')
            ->onlyTrashed()
            ->byPublishAt();

        return $this->processIndexRequestItems($request, $quotesTrashedQuery, 'body');
    }

    public function restored($id)
    {
        $quote = Quote::onlyTrashed()->find($id);
        $quote->restore();
    }

    public function forceDeleted($id)
    {
        $quote = Quote::onlyTrashed()->find($id);

        $this->redirectService->registerModelRemoval($quote);

        $quote->post()->delete();
        $quote->categories()->detach();

        $metaImage = $quote->meta_image;

        $quote->forceDelete();

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
