<?php

namespace App\Http\Controllers;

use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        return Favorite::with('favoriteable')->get();
    }

    public function toggle(Request $request)
    {
        $this->validate($request, [
            'favouritable' => 'required',
            'id' => 'required'
        ]);

        $favouritableClass = $request->favouritable;
        $modelToFavourite = $favouritableClass::find($request->id);
        $modelToFavourite->toggleFavorite();

        return response()->json($modelToFavourite->isFavorited());
    }

    public function ajaxAddFavorite(Request $request)
    {
        return Favorite::create($request->all());
    }

    public function ajaxDeleteFavorite($id)
    {
        Favorite::destroy($id);
        return response()->json("ok");
    }
}
