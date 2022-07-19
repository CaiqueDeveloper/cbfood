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
}
