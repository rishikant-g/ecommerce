<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use App\Cart;

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
             $sessionId =strtotime(now()).uniqid();
        
            if(empty(Session('sessionId'))){
                Session(['sessionId' => $sessionId]);
            }
    
            view()->composer('*', function ($view) {
                $sessionId = Session('sessionId');
                $count = Cart::where(['session_id' => $sessionId])->sum('quantity');
                $view->with('count', $count);
            });
    }
}
