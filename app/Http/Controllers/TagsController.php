<?php

namespace App\Http\Controllers;

use App\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tags::all();
    }
}
