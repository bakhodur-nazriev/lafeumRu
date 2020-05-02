<?php

namespace App\Http\Controllers;

use App\Category;
use App\Channel;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Channel::class);
    }

    public function index()
    {
        $channels = Channel::all();
        return view('/channels', compact('channels'));
    }

    public function show($slug)
    {
        $channel = Channel::with(['videos'])->where('slug', $slug)->first();
        $channels = Channel::all();
        return view('shows.showChannel', compact(['channel', 'channels',]));
    }

    public function get()
    {
        return Channel::latest()->get();
    }

    public function store(Request $request)
    {
        return Channel::create($request->all());
    }

    public function update(Channel $channel,  Request $request)
    {
        $channel->update($request->all());
        
        return $channel;
    }

    public function destroy(Channel $channel)
    {
        $channel->delete();
    }
}
