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
        ->select('user_activity_histories.action','modules.label', DB::raw('count(*) as total'))
        ->groupBy('user_activity_histories.action')
        ->get();

        return ['resumied' => $resumied];
    }
}
