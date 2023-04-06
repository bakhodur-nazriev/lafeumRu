<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Term;
use App\Video;
use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeQuote(Quote $quote): RedirectResponse
    {
        $quote->favorite();
        return back();
    }

    public function destroyQuote(Quote $quote): RedirectResponse
    {
        $quote->unFavorite();
        return back();
    }

    public function storeTerm(Term $term): RedirectResponse
    {
        $term->favorite();
        return back();
    }

    public function destroyTerm(Term $term): RedirectResponse
    {
        $term->unFavorite();
        return back();
    }

    public function storeVideo(Video $video): RedirectResponse
    {
        $video->favorite();
        return back();
    }

    public function destroyVideo(Video $video): RedirectResponse
    {
        $video->unFavorite();
        return back();
    }
}
