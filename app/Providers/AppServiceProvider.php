<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Components\Alert;
use App\View\Components\Inputs\Button;
use App\View\Components\Forms\Button as FormsButton;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
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
        Blade::if('env', function($value){
            if(config('app.env')===$value){
                return true;
            }
            return false;
        });
        //
        // Blade::component('package-alert', Alert::class);
        // Blade::component('button', Button::class);
        // Blade::component('form-button', FormsButton::class);
        Paginator::useBootstrap();
    }
}
