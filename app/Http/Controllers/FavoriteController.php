<?php

namespace App\Http\Controllers;

use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $this->validate($request, [
            'favouritable' => 'required',
            'id' => 'required'
        ]);
        
        return Auth::id();

        $favouritableClass = $request->favouritable;
        $modelToFavourite = $favouritableClass::find($request->id);

        $modelToFavourite->toggleFavorite();

        return $modelToFavourite->isFavorite();
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
