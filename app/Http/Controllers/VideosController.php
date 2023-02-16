<?php

namespace App\Http\Controllers;

use App\Category;
use App\Services\RedirectService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
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
        $categories = Category::where('type', 'App\Video')
            ->get()
            ->toTree()
            ->unique('name');

        return view("/videos", compact("categories"));
    }

    public function getVideos(): JsonResponse
    {
        $videos = Video::with([
            "categories",
            "favorites",
            "channel",
            "post"
        ])
            ->published('desc')
            ->has('channel')
            ->paginate(20);

        return response()->json(collect($videos));
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
        $video->delete();
    }

    public function getTrashed(Request $request)
    {
        $videosTrashedQuery = Video::with('channel', 'categories', 'post')
            ->onlyTrashed()
            ->byPublishAt();
        return $this->processIndexRequestItems($request, $videosTrashedQuery, 'title');
    }

    public function restored($id)
    {
        $video = Video::onlyTrashed()->find($id);
        $video->restore();
    }

    public function forceDeleted($id)
    {
        $video = Video::onlyTrashed()->find($id);

        $this->redirectService->registerModelRemoval($video);

        $video->post()->delete();
        $video->categories()->detach();

        $video->forceDelete();
    }
}
