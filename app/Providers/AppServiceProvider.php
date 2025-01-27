<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        // if (App::environment('production')) {
        //     URL::forceScheme('https');
        // }

        // Paginator::useBootstrap();

        View::composer('layouts.master', function ($view) {
            if (Auth::check()) {  // Gunakan Auth::check() untuk memastikan user sudah login
                $user = Auth::user();
                $theme = $user->theme ?? null;
                $view->with('themes', $theme);
            } 
        });
    }
}
