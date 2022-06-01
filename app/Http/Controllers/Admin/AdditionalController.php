<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdditionalController extends Controller
{
   public function index(){

   
    return view('panel.additional.index');
   }
   public function renderViewContentAdditional(){

    $additionals = Additional::getAllAdditionalsCompany();
    $view = view('panel.additional.contentViewAdditional', compact('additionals'))->render();
    return response()->json(['status' => 200, 'view' => $view]);
   }
   public function getAllAditionals(){
        $additionals = Additional::getAllAdditionalsCompany();
        return response()->json($additionals, 200);
   }
   public function getModalCreateGroupAdditional(){
       
      return view('panel.modals.additionals.modalCreateGroupAdditional');
   }
   public function getModalUpdateAdditional($id){
      $additional = Additional::find($id);
      return view('panel.modals.additionals.modalUpdateAdditional', compact('additional'));
   }
 
   public function storageGropAdditional(Request $request){

       $additional = Additional::storageAdditionalCompany(Auth::user()->company_id, $request->all());

       if($additional){
           return response()->json('success', 200);
       }else{
            return response()->json('error', 404);
       }

   }
   public function deleteAdditional($additional_id){
       
        $deleteAdditional = Additional::deleteGroupAdditional($additional_id);
        if($deleteAdditional){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 404);
        }
   }
   public function storageUpdateAdditonal(Request $request){
       
        if(Additional::where('id', $request->only('additional_id'))->update($request->except('additional_id'))){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 404);
        };
   }

}
