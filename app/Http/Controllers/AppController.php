<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Collection;

class AppController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /*public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }*/

    public function index()
    {
        $categories = Category::orderBy('_lft')->get()->each(function ($item) {
            $supported_types = Category::where('name', $item->name)
                ->orderBy('_lft')
                ->pluck('type');
            $item->post_links = $this->getCategoryPostLinks($item, $supported_types);
        })->filter(function ($cat, $index) {
            return $cat->type == "App\\Quote";
        })->toTree();

        return view('/home', compact('categories'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function privacy()
    {
        return view('privacyPolicy');
    }

    public function termsOfUse()
    {
        return view('termsOfUse');
    }

    public function aboutUs()
    {
        return view('aboutUs');
    }

    /**
     * Helpers
     */
    private function getCategoryPostLinks(Category $category, Collection $supported_types)
    {
        $links = [];

        if ($supported_types->contains('App\Quote')) {
            $links[] = [
                'href' => '/quotes/' . $category->slug,
                'label' => 'Цитаты и Афоризмы'
            ];
        }

        if ($supported_types->contains('App\Term')) {
            $links[] = [
                'href' => '/terms/' . $category->slug,
                'label' => 'Термины'
            ];
        }

        if ($supported_types->contains('App\Video')) {
            $links[] = [
                'href' => '/video/' . $category->slug,
                'label' => 'Видео'
            ];
        }

        if ($supported_types->contains('App\Term')) {
            $links[] = [
                'href' => '/vocabulary/' . $category->slug,
                'label' => 'Словарь'
            ];
        }

        return $links;
    }
}
