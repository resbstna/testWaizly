<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

       
        
        // if (!$this->app->routesAreCached()) {
        //     Passport::ignoreRoutes();
        // }

        Gate::define('isAdmin', function (User $user) {
            if( $user->role == 'admin'){
                return true;
            }
        });
        Gate::define('isUser', function ($user) {
            return $user->role == 'user';
        });

    }
}
