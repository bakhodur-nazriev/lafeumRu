<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quote;
use App\Services\RedirectService;
use App\Term;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    protected $redirectService;
    
    public function __construct(RedirectService $redirectService)
    {
        $this->authorizeResource(Category::class);
        $this->redirectService = $redirectService;
    }

    public function get(Request $request)
    {
        $categoriesQuery = Category::orderBy('_lft');

        if ($request->has('type')) {
            $categoriesQuery->where('type', $request->type);
        }

        if ($request->has('tree')) {
            return $categoriesQuery->get()->toTree();
        }

        return $categoriesQuery->get();
    }

    public function updateTree(Request $request)
    {
        $request->validate([
            'type' => 'required'
        ]);

        Category::where('type', $request->type)->rebuildTree($request->categories, true);

        return $request->categories;
    }

    public function showQuotes($categorySlug)
    {
        $category = $this->getCategory(Quote::class, $categorySlug);

        return view('shows.category', compact('category'));
    }

    public function showTerms($categorySlug)
    {
        $category = $this->getCategory(Term::class, $categorySlug);
        return view('shows.category', compact('category'));
    }

    public function showVideos($categorySlug)
    {
        $category = $this->getCategory(Video::class, $categorySlug);
        return view('shows.category', compact('category'));
    }

    public function showVocabulary($categorySlug)
    {
        $category = Category::where('type', Term::class)
            ->where('slug', $categorySlug)
            ->first();

        $terms = $this->getCategoriablesQuery(Term::class, $category)
            ->vocabulary()
            ->get();

        return view('vocabulary', compact(['category', 'terms']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);

        $newCategory = new Category(
            $request->only(['name', 'description', 'type'])
        );

        $parent = Category::find($request->parentId);

        $newCategory->save();

        if ($parent) {
            $newCategory->appendToNode($parent)->save();
        }

        return $newCategory;
    }

    public function update(Category $category, Request $request)
    {
        $category->update($request->all());

        return $category;
    }

    public function destroy(Category $category)
    {
        $this->redirectService->registerModelRemoval($category);
        $category->delete();
    }

    /**
     * Helpers
     */

    private function getCategory($categoriable, $slug)
    {
        $category = Category::where('type', $categoriable)->where('slug', $slug)->first();

        if(!$category){
            return $category;
        }

        $category->categoriables = $this->getCategoriablesQuery($categoriable, $category)
            ->orderBy('id', 'desc')
            ->paginate(30);

        return $category;
    }

    private function getCategoriablesQuery($model, $category)
    {
        $categoryIds[] = $category->id;

        $categoriableIds = $this->getCategoriableIds($categoryIds, $model);

        $categoriablesQuery = $model::whereIn('id', $categoriableIds);

        return $categoriablesQuery;
    }

    private function getCategoriableIds($categoryIds, $categoriable)
    {
        return DB::table('categoriables')
            ->where('categoriable_type', $categoriable)
            ->whereIn('category_id', $categoryIds)
            ->distinct('categoriable_id')
            ->select('categoriable_id')
            ->get()
            ->pluck('categoriable_id');
    }
}
