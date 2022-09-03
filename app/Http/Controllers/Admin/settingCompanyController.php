<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SettingCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class settingCompanyController extends Controller
{
    public function __construct() {
    
        $this->middleware('auth');
   }
   public function changeCompany(Request $request){
    if(User::where('id',auth()->user()->id)->update(['company_id' => $request->company_id ])){
        return response()->json('Success', 200);
    }       
   }
   public function updateSettingCompany(Request $request){
        $storageOrUpdateCompany = SettingCompany::where('company_id',$request->only('company_id'))->update($request->except('company_id'));
        if($storageOrUpdateCompany){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    public function OpenedOrClosedStore(Request $request){
        
        if(SettingCompany::where('company_id', Auth::user()->company_id)->update($request->all())){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
}
