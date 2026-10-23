<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        Gate::define(
            'manage-roles',
            fn (User $user): bool => $user->role === 'admin'
        );

        Gate::define(
            'use-cart',
            fn (User $user): bool => $user->role === 'customer'
        );

        User::observe(UserObserver::class);
    }

}