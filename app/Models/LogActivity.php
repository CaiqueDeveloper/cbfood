<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'login', 'logout'];

    protected static function saveLoginUser($user_id){
        return LogActivity::create(['user_id' => $user_id, 'login' => date('Y-m-d H:i:s'), 'logout' => date('Y-m-d H:i:s')]);
    }
    protected static function saveLogoutUser($user_id){
        return LogActivity::where('user_id',$user_id)->orderBy('id','desc')->update(['logout' => date('Y-m-d H:i:s')]);
    }
    public function users(){
      return  $this->belongsTo(User::class ,'user_id', 'id');
    }

    protected static function userLogged($start = null, $end = null){
        
        if($start == null && $end == null){
            $start = date('Y-m-d');
            $end = date('Y-m-d');
        }

        return LogActivity::whereBetween('login', [$start." 00:00:00", $end." 23:59:59"])
        ->whereNotIn('user_id', User::getAllUserManagerPlataform())
        ->with('users')
        ->groupBy('user_id')
        ->get();
    }
    protected static function companyLogged($start = null, $end = null){
        
        if($start == null && $end == null){
            $start = date('Y-m-d');
            $end = date('Y-m-d');
        }

        return LogActivity::whereBetween('login', [$start." 00:00:00", $end." 23:59:59"])
        ->whereNotIn('user_id', User::getAllUserManagerPlataform())
        ->with('users.companies')
        ->groupBy('user_id')
        ->get();
    }
    protected static function getTotalCompaniesActiveUser(){

        $companies = [];
        foreach(self::companyLogged() as $user){
            $companies[] = $user->users->companies()->where('status', 1)->select('companies.id', 'companies.name')->get();
        }
        return $companies;
    }
    protected static function getTotalCompaniesInativeUser(){
        $companiesLogged = [];
        foreach(self::getTotalCompaniesActiveUser() as $key => $company){

            $companiesLogged['company_id'][] = $company[0]['id'];
        }

        return isset($companiesLogged['company_id']) ? Company::whereNotIn('id', $companiesLogged['company_id'])->get() : $companiesLogged;
    }
}
