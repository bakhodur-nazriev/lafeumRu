<?php

namespace App\Http\Controllers;

use App\Services\RedirectService;
use Illuminate\Http\Request;
use App\Video;

class VideosController extends Controller
{
    protected $redirectService;

    public function __construct(RedirectService $redirectService)
    {
        $this->authorizeResource(Video::class);
        $this->redirectService = $redirectService;
    }

    public function index()
    {
        $videos = Video::with([
            'channel',
            'favorites',
            'categories'
        ])->published('desc')->paginate(30);

        return view('/videos', compact(['videos',]));
    }

    public function get(Request $request)
    {
        $videosQuery = Video::with('channel', 'categories', 'post')->byPublishAt();

        return $this->processIndexRequestItems($request, $videosQuery, 'title');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'channel_id' => 'required',
            'link' => 'required',
            'duration' => 'required',
            'categories' => 'required|array',
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
        $this->redirectService->registerModelRemoval($video);

        $video->post()->delete();
        $video->categories()->detach();
        $video->delete();
    }
}
