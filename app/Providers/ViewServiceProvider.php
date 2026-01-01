<?php

namespace App\Providers;

use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.header', function ($view) {

            if (Auth::check()) {
                $notifications = Notifications::where('user_id', Auth::user()->id)
                    ->where('status', 'baru')
                    ->latest()
                    ->limit(3)
                    ->get();
                $newNotif = Notifications::where('user_id', Auth::user()->id)
                    ->where('status', 'baru')
                    ->count();
            } else {
                $notifications = collect();
            }

            $view->with([
                'notifications' => $notifications,
                'newNotif' => $newNotif
            ]);
        });
    }
}
