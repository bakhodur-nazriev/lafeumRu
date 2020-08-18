<?php

namespace App\Providers;

use App\Author;
use App\Category;
use App\Channel;
use App\Http\View\Composers\CategoriesSidebar;
use App\Http\View\Composers\CountItemsComposer;
use App\Http\View\Composers\DailyPostsComposer;
use App\Http\View\Composers\MetatagsComposer;
use App\Knowledge;
use App\Observers\SluggableObserver;
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
        View::composer('layouts.countItems', CountItemsComposer::class);

        /* Right Sidebar Daily Posts Block View */
        View::composer('layouts.right-sidebar.rightSidebar', DailyPostsComposer::class);

        /* View Categories */
        View::composer('layouts.left-sidebar.categories', CategoriesSidebar::class);

        /* Meta tags */
        View::composer('layouts.meta-tags', MetatagsComposer::class);

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

        Category::observe(SluggableObserver::class);
        Author::observe(SluggableObserver::class);
        Channel::observe(SluggableObserver::class);
        Knowledge::observe(SluggableObserver::class);
    }
}
