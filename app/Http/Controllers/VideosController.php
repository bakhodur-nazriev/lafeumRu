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
        // foreach ($videos->channel as $channel) {
        //     return $channel->name;
        // }
        // return $videos;
        return view('/videos', compact('videos'));
    }
}
