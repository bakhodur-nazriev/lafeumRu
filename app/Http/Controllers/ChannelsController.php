<?php

namespace App\Http\Controllers;

use App\Channels;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function index()
    {
        return view('/channels');
    }
}
