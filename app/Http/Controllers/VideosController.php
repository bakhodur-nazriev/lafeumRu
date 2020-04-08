<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Video;

class VideosController extends Controller
{
    public function index()
    {
        $categories = Category::where('type', Video::class)->get()->toTree()->unique("name");
        $videos = Video::with(["channel", "favorites", "categories"])->paginate(10);
        return view("/videos", compact(["videos", "categories"]));
    }

    public function get()
    {
        return Video::with("channel")->latest()->get();
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
