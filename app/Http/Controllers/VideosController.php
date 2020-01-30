<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\Video;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::with('channel')->get();
        return view('/videos', compact('videos'));
    }

    public function get()
    {
        return Video::with('channel')->latest()->get();
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
