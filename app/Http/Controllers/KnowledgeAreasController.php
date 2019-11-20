<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KnowledgeAreasController extends Controller
{
    public function index()
    {
        return view('/knowledge-areas');
    }
}
