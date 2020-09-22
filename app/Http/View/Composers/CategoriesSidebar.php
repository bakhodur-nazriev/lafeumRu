<?php

namespace App\Http\View\Composers;

use App\Category;
use App\Quote;
use App\Term;
use App\Video;
use Illuminate\View\View;

class CategoriesSidebar
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = $view->getData();

        $categories = [];

        if (!$data['type']) {
            $view->with('categories', $categories);
            return;
        }

        $categories = Category::where('type', $data['type'])
            ->orderBy('_lft')
            ->get();

        $this->processCategories($categories, $data);

        $view->with('categories', $categories->toTree());
    }

    /**
     * Helpers
     */

    private function processCategories($categories, $composerData)
    {
        $categories->each(function ($cat) use ($composerData) {

            $this->addActive($cat, $composerData);

            $this->addLinkToCategory($cat, $composerData);
        });
    }

    private function addLinkToCategory($category, $composerData)
    {
        if(array_key_exists('linkPrefix', $composerData)){
            $category->link = "/{$composerData['linkPrefix']}/{$category->slug}";
            return;
        }

        switch ($composerData['type']) {
            case Quote::class:
                $category->link = "/quotes/{$category->slug}";
                break;
            case Term::class:
                $category->link = "/terms/{$category->slug}";
                break;
            case Video::class:
                $category->link = "/videos/{$category->slug}";
                break;
        }
    }

    private function addActive($category, $data)
    {
        $category->active = false;

        $activeId = null;

        if (isset($data['active'])) {
            $activeId = $data['active'];
        }

        if ($category->id == $activeId) {
            $category->active = true;
        }
    }
}
