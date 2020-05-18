<?php

namespace App\Providers;

use App\Http\View\Composers\DailyPostsComposer;
use Illuminate\Support\ServiceProvider;

class DailyPostsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->composeDailyPosts();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function composeDailyPosts()
    {
        view()->composer('layouts.right-sidebar.rightSidebar', DailyPostsComposer::class);
    }
}
