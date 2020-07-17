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
        $knowledgeAreas = Knowledge::orderBy('name')->get()->toTree();
        return view('knowledgeArea', compact('knowledgeAreas'));
    }

    public function show(Knowledge $knowledge)
    {
        $knowledgeAreas = Knowledge::all();
        
        $currentKnowledgeArea = $knowledge;
        $currentKnowledgeArea->terms = $knowledge->terms()->latest()->paginate(30);
        
        return view('shows.knowledge', compact(['currentKnowledgeArea', 'knowledgeAreas',]));
    }

    public function get(Request $request)
    {
        if($request->has('tree')){
            return Knowledge::latest()
                ->get()
                ->each(function ($item) {
                    $item->append('linked_knowledge');
                })
                ->toTree();
        } 
        
        $knowledgeAreas = Knowledge::where('parent_id', '<>', null)
            ->latest()
            ->get()
            ->each(function ($item) {
                $item->append('linked_knowledge');
            });
        
        return $knowledgeAreas;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $newKnowledgeArea = Knowledge::create($request->all());

        if(
            $request->has('linked_knowledge') && 
            gettype($request->linked_knowledge) === "array"
        ){
            $relatedKnowledge = Knowledge::whereIn('id', $request->linked_knowledge)->get();

            $newKnowledgeArea->linkEntities($relatedKnowledge);
        }

        return $newKnowledgeArea;
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
        
        if(
            $request->has('linked_knowledge') && 
            gettype($request->linked_knowledge) === "array"
        ){
            $relatedKnowledge = Knowledge::whereIn('id', $request->linked_knowledge)->get();

            $knowledge->syncRelatedEntities($relatedKnowledge);
        }

        return $knowledge;
    }

    public function destroy(Knowledge $knowledge)
    {
        $knowledge->unlinkAllEntities();
        $knowledge->delete();
    }
}
