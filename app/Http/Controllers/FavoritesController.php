<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Favorite;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Quote $quote)
    {
        $quote->favorite();

        return back();
    }

    public function destroy(Quote $quote)
    {
        $quote->unFavorite();

        return back();
    }
}
