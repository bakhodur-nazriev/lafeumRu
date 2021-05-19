<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Services\RedirectService;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    protected $redirectService;

    public function __construct(RedirectService $redirectService)
    {
        $this->authorizeResource(Channel::class);
        $this->redirectService = $redirectService;
    }

    public function index()
    {
        return view('/channels');
    }

    public function getChannels()
    {
        $channels = Channel::orderBy('name')->get();

        return response()->json(collect($channels));
    }

    public function showLeftSidebar()
    {
        $channelsLeftSidebar = Channel::orderBy('name')->paginate(30);

        return response()->json(collect($channelsLeftSidebar));
    }

    public function show(Channel $channel)
    {
        $channels = Channel::all();
        $channel->videos = $channel
            ->videos()
            ->published('desc')
            ->with('categories', 'channel', 'post')
            ->paginate(30);

        return view('shows.channel', compact(['channel', 'channels']));
    }

    public function get(Request $request)
    {
        $channelQuery = Channel::orderBy('name', 'asc');
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

    public function getTrashed(Request $request)
    {
        $channelTrashedQuery = Channel::onlyTrashed()->orderBy('name', 'asc');
        return $this->processIndexRequestItems($request, $channelTrashedQuery, 'name');
    }

    public function restored($id)
    {
        $channel = Channel::onlyTrashed()->find($id);
        $channel->restore();
    }

    public function forceDeleted($id)
    {
        $channel = Channel::onlyTrashed()->find($id);

        $this->redirectService->registerModelRemoval($channel);

        $channel->forceDelete();
    }
}
