<?php

namespace App\Providers;

use App\Models\ContactMessage;
use App\Models\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        View::composer('layouts.navigation', function ($view) {
            $view->with('newMessageCount', ContactMessage::where('status', ContactMessage::STATUS_NEW)->count());
        });

        View::composer('layouts.frontend', function ($view) {
            $view->with('siteSettings', Page::findBySlug('site_settings'));
        });
    }
}
