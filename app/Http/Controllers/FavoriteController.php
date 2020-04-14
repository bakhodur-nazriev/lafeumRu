<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Term;
use App\Video;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favourites = Favorite::with('favoriteable')->get();

        foreach ($favourites as $favourite) {
            
            $favouriteType = $favourite->favoriteable_type;

            switch($favouriteType){
                case Quote::class: 
                    $favourite->favoriteable->load(['author', 'categories']);
                break;

                case Term::class:
                    $favourite->favoriteable->load(['categories']);
                break;

                case Video::class:
                    $favourite->favoriteable->load(['channel', 'categories']);
                break;
            }
        }

        return $favourites;
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
