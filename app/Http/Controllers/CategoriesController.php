<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quote;
use App\Term;
use App\Video;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Category::class);
    }

    public function get(Request $request)
    {
        $categoriesQuery = Category::query();

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
        $category->delete();
    }

    /**
     * Helpers
     */

    private function getCategory($categoriable, $slug)
    {
        $category = Category::where('type', $categoriable)->where('slug', $slug)->first();

        $category->categoriables = $this->getCategoriables($categoriable, $category);
        
        return $category;
    }

    private function getCategoriables($model, $category)
    {
        $categoryDescendantIds = $category->descendants()->pluck('id');

        $categoryIds = $categoryDescendantIds;

        $categoryIds[] = $category->id;
        
        $categoriableQuery = $model::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('id', $categoryIds);
        });

        $this->addCategoriableRelations($categoriableQuery, $model);

        return $categoriableQuery->paginate(10);
    }

    private function addCategoriableRelations($categoriableQuery, $model)
    {
        switch ($model) {
            case Quote::class:
                $categoriableQuery->with('author:id,name,slug', 'categories:id,name,slug');
                break;
            case Term::class:
                $categoriableQuery->with('knowledge:id,name,slug', 'categories:id,name,slug');
                break;
            case Video::class:
                $categoriableQuery->with('channel:id,name,slug', 'categories:id,name,slug');
                break;
        }
    }
}
