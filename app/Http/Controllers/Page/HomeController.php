<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use App\Models\Company;
use App\Models\Product;
use App\Models\SettingCompany;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($slug){

        $menuCompany = SettingCompany::getCompanyUsingSlug($slug);
        return view('app.home.index', compact('menuCompany'));
    }
    public function renderViewGetProduct($product_id){
        $product = [];
        $prd = Product::find($product_id);
        $additionals = Additional::whereIn('id', array_column($prd->additionalsProduct->toArray(), 'additional_id'))->get();
        $product['product'] = $prd;
        $product['additionals'] = $additionals;
        $view = view('app.renderModalProduct', compact('product'))->render();
        return response()->json(['status' => 200, 'view' => $view]);
       }
}
