<?php

namespace App\Http\Controllers;

use App\Category;
use App\Channel;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function index()
    {
        $channels = Channel::all();
        return view("/channels", compact("channels"));
    }

    public function show($slug)
    {
        $channel = Channel::with(["videos"])->where("slug", $slug)->first();
        $channels = Channel::all();
        return view("shows.showChannel", compact("channel", "channels"));
    }

    public function get()
    {
        return Channel::latest()->get();
    }

    public function store(Request $request)
    {
        return Channel::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $channel = Channel::find($id);
        $channel->update($request->all());
        $channel->save();
        return response()->json($channel);
    }

    public function delete($id)
    {
        Channel::destroy($id);
        return response()->json("ok");
    }
}
