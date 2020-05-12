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
            ->get();

        $this->addLinkToCategories($categories, $data['type']);

        $view->with('categories', $categories->toTree());
    }

    /**
     * Helpers
     */

    private function addLinkToCategories($categories, $type)
    {
        $categories->each(function($cat) use($type){
            switch ($type) {
                case Quote::class:
                    $cat->link = "/quotes/{$cat->slug}";
                    break;
                case Term::class:
                    $cat->link = "/terms/{$cat->slug}";
                    break;
                case Video::class:
                    $cat->link = "/videos/{$cat->slug}";
                    break;
            }
        });        
    }
}
