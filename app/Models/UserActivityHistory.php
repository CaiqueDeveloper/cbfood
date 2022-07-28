<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserActivityHistory extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'action', 'day'];

    protected static function listUserUsabilityHistory($start = null, $end = null){
        
        if($start == null && $end == null){
            $start = date('Y-m-d');
            $end = date('Y-m-d');
        }

        $resumied = UserActivityHistory::join('modules', 'modules.url', '=', 'user_activity_histories.action')
        ->whereBetween('day' , [$start." 00:00:00", $end." 23:59:59"])
        ->select('user_activity_histories.action','modules.label', DB::raw('count(modules.label) as total'))
        ->groupBy('modules.label')
        ->get();


        return ['resumied' => $resumied];
    }
    protected static function getSatistcOfUsability($start, $end, $modules,$company){
       // return LogActivity::userLogged($start, $end, $company);
        return self::processingRequesUser(LogActivity::userLogged($start, $end, $company));
        
        
    }
    private static function processingRequesUser($data){
        $users = [];
        foreach($data as $key => $d){
            $users[$key]['id'] = $d->user_id;
            $users[$key]['name'] = $d->users->name;
            $users[$key]['company'] = $d->users->company->name;
            $users[$key]['total_company'] = count($d->users->companies);
            $users[$key]['profile'] = $d->users->profiles->last()->label;
            $users[$key]['last_access'] = date('d/m/Y H:i:s',strtotime($d->login));
        }
        return $users;
    }
}
