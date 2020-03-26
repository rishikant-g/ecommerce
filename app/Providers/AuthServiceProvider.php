<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Schema::defaultStringLength(191);

        Gate::define('add-category', function ($user) {
            $check = 0;
            foreach($user->roles as $role){
                if($role->role_name == 'admin'){
                    $check++;
                }
            }
            return $check > 0
                        ? Response::allow()
                        : Response::deny('You must be a  administrator.');
        });
    }
}
