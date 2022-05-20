<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorageAddressRequest;
use App\Http\Requests\StorageCompanyRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\SettingCompany;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class CompanyController extends Controller
{
   public function getCompany(Request $request){
        return view('panel.company.index');
   } 
   public function updateOrInserAddreCompany(StorageAddressRequest $request){

        $id = $request->only('company_id');
        $storageAddress = Address::storageAddressCompany($id['company_id'], $request->all());
        if($storageAddress){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    public function storageOrCreateCompany(StorageCompanyRequest $request){
           
        if($request->only('company_id') != null){
           $storageOrUpdateCompany = Company::where('id',$request->only('company_id'))->update($request->except('company_id'));
            if($storageOrUpdateCompany){
                return response()->json('success', 200);
            }else{
                return response()->json('error', 400);
            }
        }else{
            $storageOrUpdateCompany = Company::create($request->all());
            if($storageOrUpdateCompany){
                return response()->json('success', 200);
            }else{
                return response()->json('error', 400);
            }
        }
    }
  
    
    
 
}
