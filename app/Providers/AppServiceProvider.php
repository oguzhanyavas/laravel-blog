<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Config;
use App\Models\Inbox;
use Auth;
use View;

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
        if (!$this->app->runningInConsole()) {
            $configs = Config::orderBy('id', 'ASC')->first();
            View::share('configs', $configs);
        }
        Route::resourceVerbs([
            'create' => 'olustur',
            'edit' => 'duzenle',
            'destroy' => 'sil',
        ]);
    }
}
