<?php

namespace App\Providers;

use App\Category;
use App\Http\View\Composers\CategoriesSidebar;
use App\Quote;
use App\Term;
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
        View::composer('layouts.categories', CategoriesSidebar::class);

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
