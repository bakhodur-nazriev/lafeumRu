<?php

namespace App\Http\Controllers;

use App\Category;
use App\Knowledge;
use Illuminate\Http\Request;

class KnowledgesController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Knowledge::class, 'knowledge');
    }

    public function index()
    {
        $knowledgeAreas = Knowledge::latest()->get();
        return view('knowledgeArea', compact('knowledgeAreas'));
    }

    public function show(Knowledge $knowledge)
    {
        $knowledgeAreas = Knowledge::all();
        
        $currentKnowledgeArea = $knowledge;
        $currentKnowledgeArea->terms = $knowledge->terms()->latest()->paginate(30);
        
        return view('shows.knowledge', compact(['currentKnowledgeArea', 'knowledgeAreas',]));
    }

    public function get()
    {
        return Knowledge::latest()->get()->toTree();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        return Knowledge::create($request->all());
    }

    public function updateTree(Request $request)
    {
        $request->validate([
            'knowledgeAreas' => 'required'
        ]);

        Knowledge::rebuildTree($request->knowledgeAreas);

        return Knowledge::latest()->get()->toTree();
    }

    public function update(Knowledge $knowledge, Request $request)
    {
        $knowledge->update($request->all());
        
        return $knowledge;
    }

    public function destroy(Knowledge $knowledge)
    {
        $knowledge->delete();
    }
}
