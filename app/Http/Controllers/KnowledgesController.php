<?php

namespace App\Http\Controllers;

use App\Knowledge;
use Illuminate\Http\Request;

class KnowledgesController extends Controller
{
    public function index()
    {
        $knowledgeAreas = Knowledge::all();
        return view('/knowledge.index', compact('knowledgeAreas'));
    }

    public function get()
    {
        $knowledgeAreas = Knowledge::all();
        return response()->json($knowledgeAreas);
    }


}
