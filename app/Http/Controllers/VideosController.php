<?php

namespace App\Http\Controllers;

use App\Category;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Http\Request;
use App\Video;

class VideosController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Video::class);
    }

    public function index()
    {
        $videos = Video::with(['channel', 'favorites', 'categories'])->paginate(10);
        return view('/videos', compact(['videos',]));
    }

    public function get(Request $request)
    {
        $videosQuery = Video::with("channel", "categories");
        return $videosQuery->latest()->paginate($request->perPage ?: 10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'channel_id' => 'required',
            'link' => 'required',
            'duration' => 'required',
            'categories' => 'required|array',
            'created_at' => 'required'
        ]);

        $newVideo = Video::create($request->all());

        $newVideo->categories()->attach($request->categories);

        $newVideo->post()->create();

        return $newVideo;
    }

    public function update(Video $video, Request $request)
    {
        $video->update($request->all());

        if ($request->has('categories')) {
            $video->categories()->sync($request->categories);
        }

        return $video;
    }

    public function destroy(Video $video)
    {
        $video->post()->delete();
        $video->categories()->detach();
        $video->delete();
    }
}
