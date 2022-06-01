<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Category;
use App\Models\Company;
use App\Models\SettingCompany;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = self::getAllCategoryCompany();
        return view('panel.category.index', compact('categories'));
    }
    public function getModalCreateCategory(){
        return view('panel.modals.category.modalCreateCategory');
    }
    public function getModalUpdateCategory($id){
        $category = Category::find($id);
        return view('panel.modals.category.modalUpdateCategory', compact('category', 'id'));
    }
    public function getAllCategoryCompany(){

        $company = Company::find(Auth::user()->id);
        return $company->category;
    }
    public function storageCategory(Request $request){

        $storageCategory = Category::storageCategryCompany(Auth::user()->company_id,$request->all());
        if($storageCategory){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    public function deleteCategory($id){

        $deleteCategory = Category::find($id)->delete();
        if($deleteCategory){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    public function storageUpdateCategory(Request $request){
        $updateCategory = Category::where('id',$request->company_id)->update($request->except('company_id'));
        if($updateCategory){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
  
}
