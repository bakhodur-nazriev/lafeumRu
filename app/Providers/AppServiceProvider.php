<?php

namespace App\Providers;

use App\Category;
use App\Video;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        /* View Categories */
        View::composer('layouts.categories', function ($view) {
            $categoryType = $view->getData();

            $categories = [];

            if ($categoryType['type']) {
                $categories = Category::where('type', $categoryType['type'])
                    ->get()
                    ->toTree()
                    ->unique("name");
            }

            $view->with('categories', $categories);
        });

        /* Right Sidebar View */
        View::composer('layouts.rightSidebar', function ($view) {

        });
    }
}
