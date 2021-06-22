<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quote;
use App\Services\RedirectService;
use App\Term;
use App\Video;
use Illuminate\Database\Eloquent\Model;
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
        //$categories = $this->getCategory(Quote::class, $categorySlug);

        $categories = Category::quote()->get()->toTree()->unique('name');

        return view('shows.category', compact('categories'));
    }

    public function getShowQuotes($categorySlug)
    {
        $categories = $this->getCategory(Quote::class, $categorySlug);

        return response()->json(collect($categories));
    }

    public function showTerms($categorySlug)
    {
//        $categories = $this->getCategory(Term::class, $categorySlug,
//            function ($categoriesQuery) {
//                return $categoriesQuery->orderBy('term_type_id', 'asc');
//            }
//        );
        $categories = Category::term()->get()->toTree()->unique('name');

        return view('shows.category', compact('categories'));
    }

    public function getShowTerms($categorySlug)
    {
        $category = $this->getCategory(Term::class,
            $categorySlug,
            function ($categoriesQuery) {
                return $categoriesQuery->orderBy('term_type_id', 'asc');
            }
        );

        return response()->json(collect($category));
    }

    public function showVideos($categorySlug)
    {
//        $categories = $this->getCategory(Video::class, $categorySlug);

        $categories = Category::where('type', 'App\Video')->get()->toTree()->unique('name');

        return view('shows.category', compact('categories'));
    }

    public function getShowVideos($categorySlug)
    {
        $category = $this->getCategory(Video::class, $categorySlug);

        return response()->json(collect($category));
    }

    public function showVocabulary($categorySlug)
    {
        $categories = Category::term()->get()->toTree()->unique('name');

        return view('vocabulary', compact('categories'));
    }

    public function getShowVocabulary($categorySlug)
    {
        $category = Category::where('type', Term::class)
            ->where('slug', $categorySlug)
            ->first();

        $terms = $this->getCategoriablesQuery(Term::class, $category)
            ->vocabulary()
            ->get();

        return response()->json(collect([$category, $terms]));
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

    private function getCategory($categoriable, $slug, callable $queries = null)
    {
        $category = Category::where('type', $categoriable)
            ->where('slug', $slug)
            ->first();

        if (!$category) {
            abort(404);
        }

        $categoriablesQuery = $this->getCategoriablesQuery($categoriable, $category);

        $category->categoriables = $categoriablesQuery
            ->published('desc')
            ->paginate(20);

        return $category;
    }

    private function getCategoriablesQuery($model, $category)
    {
        $categoryIds[] = $category->id;

        $categoriableIds = $this->getCategoriableIds($categoryIds, $model);

        $categoriablesQuery = $model::whereIn('id', $categoriableIds);

        if ($model == 'App\\Quote') {
            return $categoriablesQuery->with([
                'author:id,name,slug',
                'categories:id,name,slug',
                'post'
            ]);
        };

        if ($model == 'App\\Term') {
            return $categoriablesQuery->with([
                'categories',
                'termType',
                'post'
            ]);
        };

        if ($model == 'App\\Video') {
            return $categoriablesQuery->with([
                'channel',
                'favorites',
                'categories',
                'post'
            ]);
        }
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
