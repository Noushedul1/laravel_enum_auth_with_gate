<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isSuperadmin',function($user){
            return $user->role == 'super_admin';
        });
        Gate::define('isManager',function($user){
            return $user->role == 'manager';
        });
        Gate::define('isEditor',function($user){
            return $user->role == 'editor';
        });
    }
}
