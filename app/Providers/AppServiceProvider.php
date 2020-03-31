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
       
        $sessionId =  Session('sessionId');
        // config(['custom.sessionId' => $sessionId]);
        // echo config('custom.sessionId');exit;
        // var_dump(config('custom.sessionId'));exit;
        // if(config('custom.sessionId') == NULL ){
        //     config(['custom.sessionId' => $sessionId]);
        // }
        

        $count = Cart::where(['session_id' => $sessionId])->sum('quantity');
        // $count = \App\Cart::sum('quantity');
        // echo $count;exit;
        View::share('count',$count);
    }
}
