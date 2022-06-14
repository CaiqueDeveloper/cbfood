<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Notify;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function getNotifyCompany(){
       return Notify::getNotificationOrderCompany();
    }
    public function renderBoxNotifyCompany(){

        $notify = self::getNotifyCompany();
        $view = view('panel.notify.index', compact('notify'))->render();
        return response()->json(['status' => 200, 'view' => $view]);
    }
    
}
