<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('create-post', function (User $user) {
            return $user->rol == 'Propietario' || $user->rol == 'Admin';
        });
        Gate::define('delete-post', function (User $user, Post $post) {
            return $user->id == $post->user_id || $user->rol == "Admin";
        });
        Gate::define('edit-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });
        Gate::define('read-posts', function (User $user, Post $post) {
            return $user->id == $post->user_id || $user->rol == "Admin";
        });


    }
}
