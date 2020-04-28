<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

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
}
