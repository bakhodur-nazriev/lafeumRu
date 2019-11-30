<?php

namespace App\Http\Controllers;

use App\Channels;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function index()
    {
        $channels = Channels::all();
        return view('/channels', compact('channels'));
    }
}
