<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\View\Composers\PersonalComposer;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin-options', function (User $user, $role) {
            if ($user->hasRole($role)) {
                return true;
            }
        });

        View::composer('paneles.personal', PersonalComposer::class);
    }
}
