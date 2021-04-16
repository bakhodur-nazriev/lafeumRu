<?php

namespace App\Http\Controllers;

use App\Knowledge;
use App\Services\RedirectService;
use Illuminate\Http\Request;

class KnowledgesController extends Controller
{
    protected $redirectService;

    public function __construct(RedirectService $redirectService)
    {
        $this->authorizeResource(Knowledge::class, 'knowledge');
        $this->redirectService = $redirectService;
    }

    public function index()
    {
        return view('knowledgeArea');
    }

    public function getKnowledgeAreas()
    {
        $knowledgeAreas = Knowledge::orderBy('_lft')->get()->toTree();
        return response()->json(collect($knowledgeAreas));
    }

    public function show(Knowledge $knowledge)
    {
        $knowledgeAreas = Knowledge::get()->toTree();

        $currentKnowledgeArea = $knowledge;
        $currentKnowledgeArea->terms = $knowledge->terms()
            ->orderBy('term_type_id', 'asc')
            ->published('desc')
            ->paginate(30);

        return view('shows.knowledge', compact(['currentKnowledgeArea', 'knowledgeAreas',]));
    }

    public function get(Request $request)
    {
        if ($request->has('tree')) {
            return Knowledge::orderBy('_lft')
                ->latest()
                ->get()
                ->each(function ($item) {
                    $item->append('linked_knowledge');
                })
                ->toTree();
        }

        $knowledgeAreas = Knowledge::orderBy('_lft')
            ->where('parent_id', '<>', null)
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

        if (
            $request->has('linked_knowledge') &&
            gettype($request->linked_knowledge) === "array"
        ) {
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

        return Knowledge::orderBy('_lft')->latest()->get()->toTree();
    }

    public function update(Knowledge $knowledge, Request $request)
    {
        $knowledge->update($request->all());

        if (
            $request->has('linked_knowledge') &&
            gettype($request->linked_knowledge) === "array"
        ) {
            $relatedKnowledge = Knowledge::whereIn('id', $request->linked_knowledge)->get();

            $knowledge->syncRelatedEntities($relatedKnowledge);
        }

        return $knowledge;
    }

    public function destroy(Knowledge $knowledge)
    {
        $this->redirectService->registerModelRemoval($knowledge);

        $knowledge->unlinkAllEntities();
        $knowledge->delete();
    }
}
