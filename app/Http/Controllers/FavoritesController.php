<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Term;
use App\Video;
use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get()
    {
        $quotes = DB::table('')->get();
        return Favorite::all();
    }

    public function storeQuote(Quote $quote)
    {
        $quote->favorite();

        return back();
    }

    public function destroyQuote(Quote $quote)
    {
        $quote->unFavorite();

        return back();
    }

    public function storeTerm(Term $term)
    {
        $term->favorite();

        return back();
    }

    public function destroyTerm(Term $term)
    {
        $term->unFavorite();

        return back();
    }

    public function storeVideo(Video $video)
    {
        $video->favorite();

        return back();
    }

    public function destroyVideo(Video $video)
    {
        $video->unFavorite();

        return back();
    }
}
