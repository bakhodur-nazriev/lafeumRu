<?php

namespace App\Http\Controllers;

use App\Channels;
use Illuminate\Http\Request;

use App\Videos;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Videos::first();
        $channel = Channels::all();
        // return $channel;
        // return $videos;

        return view('/videos', compact('videos', 'channel'));
    }
}
