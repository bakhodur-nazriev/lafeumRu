<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $channels = Channel::all();

        return view('/home', compact('channels'));
    }

    // public function show(Request $request)
    // {
    //     $user = User::find($request->id);
    //     return view('home', compact('user'));
    // }
}
