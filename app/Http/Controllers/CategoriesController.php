<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function get(Request $request)
    {
        $categoriesQuery = Category::query();

        if($request->has('type')){
            $categoriesQuery->where('type', $request->type);
        }

        return $categoriesQuery->get()->toTree();
    }


