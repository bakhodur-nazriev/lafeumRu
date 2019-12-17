<?php

namespace App\Http\Controllers;

use App\Knowledge;
use Illuminate\Http\Request;

class KnowledgesController extends Controller
{
    public function index()
    {
        $knowledges = Knowledge::all();
        return view('/knowledge.index', compact('knowledges'));
    }

    public function show(Knowledge $knowledge)
    {
        return view('/knowledge.show', compact('knowledge'));
    }

    public function create()
    {
        return view('knowledges.create');
    }
}
