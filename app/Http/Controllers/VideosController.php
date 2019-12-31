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
        $videos = Video::with('channel')->get();
        return response()->json($videos);
    }
}
