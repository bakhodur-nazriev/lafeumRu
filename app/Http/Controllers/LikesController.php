<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Quote $quote)
    {

    }

    public function remove(Quote $quote)
    {

    }
}
