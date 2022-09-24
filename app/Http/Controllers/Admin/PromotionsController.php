<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    public function __construct() {
    
        $this->middleware('auth');
   }
    public function index(){
        return view('panel.promotions.index');
    }
    protected function showModalCreateNewPromotion(){
        return view('panel.modals.promotions.modalCreateNewPromotion');
    }
    protected function getDataRenderSelector(Request $request){
       switch($request->typeItemPromotion){
            case 'category':
                return response()->json(Category::getAllCategoryCompany(), 200);
            break;
            case 'product':
                //dd(Product::getAllProductCompany(auth()->user()->company_id, false));
                return response()->json(Product::getAllProductCompany(auth()->user()->company_id, false), 200);
            break;
            case 'store':
            break;
            default:
                return response()->json(['status' => 400, 'message' => 'Type Item not maping'], 400);
            break;
       }
    }
    protected function storagePromotion(Request $request){
        
        if(Promotion::storage($request->all())){
            return response()->json('seccess', 200);
        }else{
            return response()->json('error', 500);
        }
    }
    protected function getAllPromotions (Request $request){
        return response()->json(Promotion::getData(), 200);
    }
}
