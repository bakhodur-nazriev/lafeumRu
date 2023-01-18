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
        return $quote->favorite();
    }

    public function delete($id)
    {
        Favorite::destroy($id);

        return response()->json("success");
    }

    /*public function get()
    {
        return response()->json(Favorite::all());
    }*/
}
