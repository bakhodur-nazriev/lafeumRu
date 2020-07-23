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

    public function index()
    {
        $categories = Category::get()->each(function ($item) {
            $supported_types = Category::where('name', $item->name)
                ->get('type')
                ->pluck('type');
            $item->post_links = $this->getCategoryPostLinks($item, $supported_types);
        })->toTree()->unique('name');

        return view('/home', compact('categories'));
    }

    public function dashboard()
    {
        return view('dashboard');
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
                'label' => 'Цитаты'
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
