<?php

namespace App\Http\Controllers;

use App\Category;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Http\Request;
use App\Video;

class VideosController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Video::class);
    }

    public function index()
    {
        $videos = Video::with(['channel', 'favorites', 'categories'])->paginate(10);
        return view('/videos', compact(['videos',]));
    }

    public function get(Request $request)
    {
        $videosQuery = Video::with("channel");

        if ($request->has("favourite")) {
            $videosQuery->whereHas("favorites", function ($query) {
                $query->where("user_id", Auth::id());
            });
        }
        return $videosQuery->latest()->with("favorites")->first();
    }

    public function store(Request $request)
    {
        return Video::create($request->all());
    }

    public function update(Video $video, Request $request)
    {
        $video->update($request->all());

        return $video;
    }

    public function destroy(Video $video)
    {
        $video->delete();
    }
}
