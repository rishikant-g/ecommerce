<?php

namespace App\Http\Middleware;

use Closure;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $count =0;
        $user = \Auth::user();
       
        foreach($user->roles as $role){
            if($role->role_name == 'customer'){
                $count++;
            }
        }
        if($count > 0){
            return redirect('/shop/home');
        }
        

        return $next($request);
    }
}
