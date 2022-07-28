<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\LogActivity;
use App\Models\Module;
use App\Models\User;
use App\Models\UserActivityHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemUsabilityControlController extends Controller
{
    public function index(){
        $modules = Module::where('hasModules', 1)
        ->get();
        $companiesUser = Auth()->user()->companies()->where('status', 1)->get();
        return view('panel.systemUsabilityControl.index', compact('modules', 'companiesUser'));
    }
    protected function summaryIdicator(Request $request){
        
        $goalCompaniesActive = (count(LogActivity::getTotalCompaniesActiveUser()) / count(Company::where('status', 1)->get()))* 100;
        $goalCompaniesInative = (count(LogActivity::getTotalCompaniesInativeUser()) / count(Company::where('status', 1)->get())) * 100;
        $goaUsersActive = (count(LogActivity::userLogged($request->start, $request->end, $request->modules,$request->company)) / count(User::getAllUser())) * 100;

        return response()->json(
            ['usersActive' => ['goal' => UltilsController::percentage($goaUsersActive), 'total' => count(LogActivity::userLogged($request->start, $request->end, $request->modules,$request->company))],
            'companiesActive' => ['goal' => UltilsController::percentage($goalCompaniesActive), 'total' => count(LogActivity::getTotalCompaniesActiveUser())], 
            'companiesInative' => ['goal' => UltilsController::percentage($goalCompaniesInative), 'total' => count(LogActivity::getTotalCompaniesInativeUser())]]
        );
        
    }

    protected function listUserUsabilityHistory(Request $request){
        return UserActivityHistory::listUserUsabilityHistory($request->start, $request->end);
    }
    protected function getData(Request $request){

        $users = UserActivityHistory::getSatistcOfUsability($request->start, $request->end, $request->modules,$request->company);
        return response()->json($users);
    }
}
