<?php

namespace App\Providers;

use App\Ticket;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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


        /**
        Gate::define('update-ticket', function(User $user, Ticket $ticket){

            $role=auth()->user()->role;

            if ($role=='admin'){
                return $ticket;
            }else{
                return $ticket->user->is($user);
            }

        });
         **/


        Gate::before(function (User $user){
            if ($user->role_id=='1'){
                return true;
            }
    });

        Gate::define('1',function (User $user){
            if ($user->role_id=='1'){
                return true;
            }
        });

    }
}
