<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use App\Models\AdditionalItems;
use Illuminate\Http\Request;

class AdditionalItemsController extends Controller
{
    public function getModalCreateItemAdditional(){
        
        $additionals = Additional::getAllAdditionalsCompany();

        return view('panel.modals.additionals.modalCreateItemAdditional', compact('additionals'));
    }
    public function getModalUpdateIemAdditional($id){
        
        $itemAdditional = AdditionalItems::find($id);
        $additionals = Additional::getAllAdditionalsCompany();

        return view('panel.modals.additionals.modalUpdateItemAdditional', compact('additionals', 'itemAdditional'));
    }
    public function storageItemAdditional(Request $request){
        
        if(AdditionalItems::create($request->all())){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    public function deleteItemAdditional($id){
        
        if(AdditionalItems::where('id',$id)->delete()){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    public function storageUpdateItemAdditional(Request $request){
        if(AdditionalItems::where('id',$request->only('itemAdditional_id'))->update($request->except('itemAdditional_id'))){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
}
