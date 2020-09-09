<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use App\Role;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Passport::routes(function($router){
            $router->forAccessTokens();
        });
        $roles = Role::all()->map(function($item,$key){
            return $item->Name;
        });
        $mainRoles = array();
        for($i = 0 ; $i<count($roles);$i++){
           $mainRoles[ $roles[$i]] =  $roles[$i];
        }
        Passport::tokensCan($mainRoles);
        
    }
}
