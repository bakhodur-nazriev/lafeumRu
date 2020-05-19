<?php

namespace App\Providers;

use App\Http\View\Composers\CountItemsComposer;
use Illuminate\Support\ServiceProvider;

class CountItemsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->composeCountItems();
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

    public function composeCountItems()
    {
        view()->composer('layouts.countItems', CountItemsComposer::class);
    }
}
