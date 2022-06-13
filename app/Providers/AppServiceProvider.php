<?php

namespace App\Providers;

use App\Http\Controllers\Admin\UserController;
use App\Models\SettingCompany;
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
     
        view()->composer("*", function ($view){

            $excludedViews = ['auth.login','auth.requestFreeDemo', 'layouts.auth.based-auth', 'layouts.include.panel.head'];

            $subject = url()->previous();
            dd($subject);
            $search = 'https://cbfood.com.br' ;
            $trimmed = str_replace($search, '', $subject) ;
            $url = substr($subject, strpos($subject, "/app/menu/"), strpos($subject, "/app/menu/"));

            $urlAux = substr($subject, -strlen($url), strpos($subject, "/app/menu/"));
            if($trimmed == $urlAux){
                $company = SettingCompany::getCompanyUsingSlug(str_replace("/app/menu/","", $urlAux));
            }else{
                $company = [];
            }
           if(Auth::check()){
                $response = User::getInfoUserLogged();
               if($trimmed == $urlAux){
                   
                    $view->with(['response' => $response, 'company' => $company]); 
                }else{
                  
                    $view->with(['response' => $response, 'company' => $company]); 
                }
           }else{
                $view->with(['company' => $company]); 
           }
        });  
    }
}
