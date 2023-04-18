<?php

namespace App\Providers;

use App\Author;
use App\Category;
use App\Channel;
use App\Doctrine\Types\EnumType;
use Doctrine\DBAL\Types\Type;
use App\Http\View\Composers\CategoriesSidebar;
use App\Http\View\Composers\CountItemsComposer;
use App\Http\View\Composers\DailyPostsComposer;
use App\Http\View\Composers\MetatagsComposer;
use App\Knowledge;
use App\Observers\SluggableObserver;

//use ChristianKuri\LaravelFavorite\Models\Favorite;
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
        /* Right Sidebar Daily Posts Block View */
        View::composer('layouts.right-sidebar.rightSidebar', DailyPostsComposer::class);

        /* View Categories */
        View::composer('layouts.right-sidebar.categories', CategoriesSidebar::class);

        /* Meta tags */
        View::composer('layouts.meta-tags', MetatagsComposer::class);

        /* Регистрация типа "enum" в Doctrine */
        Type::addType('enum', EnumType::class);

        Category::observe(SluggableObserver::class);
        Author::observe(SluggableObserver::class);
        Channel::observe(SluggableObserver::class);
        Knowledge::observe(SluggableObserver::class);
    }
}
