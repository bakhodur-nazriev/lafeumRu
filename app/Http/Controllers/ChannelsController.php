<?php

namespace App\Http\Controllers;

use App\Category;
use App\Channel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Channel::class);
    }

    public function index()
    {
        $channels = Channel::all();
        return view('/channels', compact('channels'));
    }

    public function show(Channel $channel)
    {
        $channels = Channel::all();
        $channel->load('videos');
        return view('shows.channel', compact(['channel', 'channels']));
    }

    public function get(Request $request)
    {
        $channelQuery = Channel::latest()->first();
        return $this->processIndexRequestItems($request, $channelQuery, 'name');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        return Channel::create($request->all());
    }

    public function update(Channel $channel, Request $request)
    {
        $channel->update($request->all());

        return $channel;
    }

    public function destroy(Channel $channel)
    {
        $channel->delete();
    }
}
