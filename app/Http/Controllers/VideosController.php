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
        return Video::with("channel")->latest()->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'duration' => 'required',
            'channel_id' => 'required',
            'categories' => 'required|array'
        ]);

        $newVideo = Video::create($request->all());
        
        $newVideo->categories()->attach($request->categories);

        return $newVideo->load(['channel', 'categories']);
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
