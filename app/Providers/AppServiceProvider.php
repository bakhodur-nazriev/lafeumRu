<?php

namespace App\Providers;

use App\Category;
use App\Http\View\Composers\CategoriesSidebar;
use App\Http\View\Composers\CountItemsComposer;
use App\Http\View\Composers\DailyPostsComposer;
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
        /* Counter Posts Block View */
        View::composer('layouts.countItems.', CountItemsComposer::class);

        /* Right Sidebar Daily Posts Block View */
        View::composer('layouts.right-sidebar.rightSidebar', DailyPostsComposer::class);

        /* View Categories */
        View::composer('layouts.left-sidebar.categories', CategoriesSidebar::class);

        /* Right Sidebar User Block View */
        View::composer('layouts.right-sidebar.userBlock', function ($view) {
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
