<?php

namespace App\Http\Controllers;

use App\AuthorGroup;
use Illuminate\Http\Request;

class AuthorGroupController extends Controller
{
    public function index()
    {
        return AuthorGroup::all();
    }
}
