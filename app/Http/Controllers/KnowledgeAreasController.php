<?php

namespace App\Http\Controllers;
use App\KnowledgeAreas;
use Illuminate\Http\Request;

class KnowledgeAreasController extends Controller
{
    public function index()
    {
        $knowledges = KnowledgeAreas::all();
        return view('/knowledge-areas', compact('knowledges'));
    }
}
