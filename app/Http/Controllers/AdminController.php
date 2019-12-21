<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    protected $rederctTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('dashboard');
    }

    public function index()
    {
        return view('auth.dashboard');
    }
}
