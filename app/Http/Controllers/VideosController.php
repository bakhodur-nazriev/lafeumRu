<?php

namespace App\Http\Controllers;

use App\Category;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Http\Request;
use App\Video;

class VideosController extends Controller
{
    public function index()
    {
        $countOfFavoritesQuotes = Favorite::where('favoriteable_type', 'App\Quote')->count();
        $countOfFavoritesTerms = Favorite::where('favoriteable_type', 'App\Term')->count();
        $countOfFavoritesVideos = Favorite::where('favoriteable_type', 'App\Video')->count();

        $videos = Video::with(['channel', 'favorites', 'categories'])->paginate(10);
        return view('/videos', compact([
                'videos',
                'countOfFavoritesQuotes',
                'countOfFavoritesTerms',
                'countOfFavoritesVideos'
            ])
        );
    }

    public function get(Request $request)
    {
        $videosQuery = Video::with("channel");

        if ($request->has("favourite")) {
            $videosQuery->whereHas("favorites", function ($query) {
                $query->where("user_id", Auth::id());
            });
        }

        /*return Video::with("channel")->latest()->get();*/
        return $videosQuery->latest()->with("favorites")->first();
    }

    public function store(Request $request)
    {
        return Video::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $video = Video::find($id);
        $video->update($request->all());
        $video->save();
        return response()->json("success");
    }

    public function delete($id)
    {
        Video::destroy($id);
        return response()->json("ok");
    }
}
