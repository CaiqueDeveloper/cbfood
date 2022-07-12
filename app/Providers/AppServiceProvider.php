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

            if(Auth::check()){
                $slug = SettingCompany::where('company_id', Auth::user()->company_id)->value('slug_url');
                $company = SettingCompany::getCompanyUsingSlug($slug);
            }else{
                $company = [];
            }

           if(Auth::check()){
                $response = User::getInfoUserLogged();
               if(sizeof($company) > 0){
                   
                    $view->with(['response' => $response, 'company' => $company, 'sizeArrayCompany' => sizeof($company)]); 
                }else{
                  
                    $view->with(['response' => $response, 'company' => $company , 'sizeArrayCompany' => sizeof($company)]); 
                }
           }else{
                $view->with(['company' => $company , 'sizeArrayCompany' => sizeof($company)]); 
           }
        });  
    }
}
