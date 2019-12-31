<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function index()
    {
        $channels = Channel::all();
        return view('/channels', compact('channels'));
    }

    public function get()
    {
        $channels = Channel::all();
        return response()->json($channels);
    }
}
