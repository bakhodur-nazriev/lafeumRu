<?php

namespace App\Http\Controllers;
use App\KnowledgeArea;
use Illuminate\Http\Request;

class KnowledgeAreasController extends Controller
{
    public function index()
    {
        $knowledges = KnowledgeArea::all();
        return view('/knowledge-areas', compact('knowledges'));
    }
}
