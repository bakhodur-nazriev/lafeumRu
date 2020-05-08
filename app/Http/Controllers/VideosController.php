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
        return Video::with("channel")->paginate($request->perPage ?: 15);
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
