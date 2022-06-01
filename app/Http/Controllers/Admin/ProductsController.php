<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use App\Models\AdditionalProduct;
use App\Models\Images;
use App\Models\Product;
use App\Models\VariationProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ProductsController extends Controller
{
    public function index(){
        return view('panel.products.index');
    }
    public function getModalCreatProduct(){
        
        
        $categories = CategoryController::getAllCategoryCompany();
        $additionals = Additional::getAllAdditionalsCompany();
        return view('panel.modals.products.modalCreateProduct', compact('categories', 'additionals'));
    }
    public function storageProdudct(Request $request){
      // dd($request->all());
        $arrVariationProduct = [];
        if(isset($request->variationName)){
            foreach($request->variationName as $key => $name){
                $arrVariationProduct[$key]['variationName'] = $name;
            }
            foreach($request->variationType as $key => $type){
                $arrVariationProduct[$key]['variationType'] = $type;
            }
             foreach($request->variationPrice as $key => $price){
                $arrVariationProduct[$key]['variationPrice'] = $price;
            }
            foreach($request->fieldVariation as $key => $field){
                $arrVariationProduct[$key]['variation_id'] = $field;
            }
        }
        
       $product = $request->except('files','variationName', 'variationType', 'variationPrice', 'additionals', 'product_id');
       $additinalIds = $request->only('additionals');
       $product_id = $request->only('product_id');
       $product = Product::storageProductCompany(Auth::user()->company_id, $product_id, $product, $request->images,  $additinalIds, $arrVariationProduct);
       
        if($product){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 404);
        }
    }
    protected function getAllProducts(){

        $products = Product::all();
        return response()->json($products, 200);
    }
    protected function deleteProduct($id){

        $deleteProduct = Product::deleteProduct($id);
        if($deleteProduct){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 404);
        }
    }
    protected function getModalUpdateProduct($id){
        $product = Product::find($id);
        $categories = CategoryController::getAllCategoryCompany();
        $additionals = Additional::getAllAdditionalsCompany();
        return view('panel.modals.products.modalUpdateProduct', compact('product', 'categories', 'additionals'));
    }
    protected function deleteAdditionalProduct(Request $request){
        if(AdditionalProduct::find($request->additional_id)->delete()){
            return response()->json($request->product_id, 200);
        }else{
            return response()->json('error', 404);
        }
    }
    protected function deleteImageProduct(Request $request){
       
        if(Images::deleteImageProduct($request->image_id)){
            return response()->json($request->product_id, 200);
        }else{
            return response()->json('error', 404);
        }
    }
    protected function deleteVariationProduct(Request $request){

        if(VariationProduct::find($request->varitiation_id)->delete()){
            return response()->json($request->product_id, 200);
        }else{
            return response()->json('error', 404);
        }
    }
}
