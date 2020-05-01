<?php

namespace App\Providers;

use App\Author;
use App\Category;
use App\Channel;
use App\Knowledge;
use App\Photo;
use App\Policies\CategoriesPolicy;
use App\Policies\PostsPolicy;
use App\Quote;
use App\Term;
use App\Video;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        
        Quote::class => PostsPolicy::class,
        Term::class => PostsPolicy::class,
        Video::class => PostsPolicy::class,
        Photo::class => PostsPolicy::class,
        
        Category::class => CategoriesPolicy::class,
        Author::class => CategoriesPolicy::class,
        Knowledge::class => CategoriesPolicy::class,
        Channel::class => CategoriesPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();

        Gate::define("manage-users", function ($user) {
            return $user->hasAnyRoles(["admin"]);
        });

        Gate::define("edit-users", function ($user) {
            return $user->hasAnyRoles(["admin"]);
        });

        Gate::define("delete-users", function ($user) {
            return $user->hasRole(["admin"]);
        });
    }
}
