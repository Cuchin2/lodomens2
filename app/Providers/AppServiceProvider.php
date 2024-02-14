<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Footer;
use App\Models\User;
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
        view()->composer('layouts.footer', function ($view) {
            $footer=Footer::find(1);
            $user=User::find(1);
            $view->with('datos', [
                'title' => $footer->title,
                'content' => $footer->content,
                'address' => $footer->address,
                'phone' => $footer->phone,
                'logo' => $footer->logo,
                'email' => $footer->email,
                'order_message' => $footer->order_message,
                'redes'=> $user->socialMedia
                // Agrega más datos aquí
            ]);
        });
    }
}
