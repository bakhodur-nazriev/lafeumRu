<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $users = User::all();
        return view("auth.dashboard", compact("users"), ["user" => Auth::user()]);
    }
}
