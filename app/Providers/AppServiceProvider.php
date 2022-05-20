<?php

namespace App\Providers;

use App\Http\Controllers\Admin\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot(){  

        view()->composer('*', function ($view){
           if(Auth::check()){
                $response = User::getInfoUserLogged();
                $view->with('response', $response ); 
           }    
        });  
    }
}
