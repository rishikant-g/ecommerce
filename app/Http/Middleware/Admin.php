<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
            if($role->role_name == 'admin'){
                $count++;
            }
        }
            if($count == 0){
                if($request->ajax()){
                    return response()->json(['status' => false, 'message' =>'You are not authorized for this action']);
                }else{
                    dd('You are not authorized to for this action');
                }
                
            }
            
        
        return $next($request);
    }
}
