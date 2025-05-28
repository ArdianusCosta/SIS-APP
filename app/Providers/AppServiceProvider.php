<?php

namespace App\Providers;

use App\Models\PpdbNotifikasi;
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
        Paginator::useBootstrapFour();
        View::composer('*', function ($view) {
            $notifications = PpdbNotifikasi::latest()->take(5)->get();
            $unreadCount = PpdbNotifikasi::where('is_read', false)->count();
    
            $view->with('notifications', $notifications);
            $view->with('unreadCount', $unreadCount);
        });
    }
}
