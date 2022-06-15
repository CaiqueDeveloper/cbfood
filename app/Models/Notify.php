<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    use HasFactory;
    protected  $table = 'notifications';

    public static function getNotificationOrderCompany(){
        
        $company = Company::where('id', auth()->user()->company_id)->get();
        $notify = $company[0]->notify()->where('read_at', null)
        ->orderBy('notifications.created_at', 'desc')
        ->get();
        
        return self::processingNotification($notify);
    }

    protected static function processingNotification($notify){
        $notifications = [];
        foreach($notify as $key => $notification){
            
            $notifications[$key]['id'] = $notification->id;
            $notifications[$key]['body'] = json_decode($notification->data, true);
           $notifications[$key]['userRequesOrder'] = User::where('id', $notifications[$key]['body']['order']['user_id'])->select('users.name')->get();
        } 
        return $notifications;
    }

}
