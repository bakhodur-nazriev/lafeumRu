<?php

namespace App\Providers;

use App\Category;
use App\Video;
use ChristianKuri\LaravelFavorite\Models\Favorite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations(); //Currently only our apps are consuming API
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
            $quoteCount = Favorite::where('favoriteable_type', 'App\Quote')->count();
            $termCount = Favorite::where('favoriteable_type', 'App\Term')->count();
            $videoCount = Favorite::where('favoriteable_type', 'App\Video')->count();

            $favouriteCount = [
                'quote' => $quoteCount,
                'term' => $termCount,
                'video' => $videoCount
            ];

            $view->with('favouriteCount', $favouriteCount);
        });
    }
}
