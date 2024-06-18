<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Category;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        View::composer('*', function ($view) {
            $locale = config('app.locale');
            $view->with([
                'locale' => $locale,
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Category::observe(CategoryObserver::class);

        Gate::before(function (Admin $admin, $ability) {
            return $admin->hasRole('super admin') ? true : null;
           });

    }
}
