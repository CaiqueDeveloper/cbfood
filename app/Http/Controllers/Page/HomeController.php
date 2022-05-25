<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Controller;
use App\Models\Additional;
use App\Models\Address;
use App\Models\Company;
use App\Models\Product;
use App\Models\SettingCompany;
use App\Models\User;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    protected function getProductCart(Request $request){
       //dd($request[0]['product_id']);
        $product = [];
        $prd = Product::find($request[0]['product_id']);
        $product['product'] = $prd;
        dd($product);
    }
    protected function getModalCartItem(){

        $cartItens = \Cart::getContent();
        return view('app.modals.modalCartItem', compact('cartItens'));
    }
    protected function getModalCheckout(){
        $cartItens = \Cart::getContent();
        return view('app.modals.modalCheckout',compact('cartItens'));
    }
    protected function ckeckout(Request $request){
        //dd($request->only('name', 'email', 'password', 'number_phone'));
        //Get Data User
       
        $user = UserController::storage($request->only('name', 'email', 'password', 'number_phone'));
        $credentials = $request->only('number_phone', 'password');
        Auth::attempt($credentials);
        $address = AddressController::storageAddress($user->id, $request->except('name', 'email', 'password', 'credcard', 'money', 'pix'));
        $order = OrderController::getOredsUser(\Cart::getContent(), $request->only('credcard', 'money', 'pix'), $address->id);
        
        if(isset($user) && isset($address) && isset($order)){
            
            $response['user'] = User::find(Auth::user()->id)->get();
            return response()->json($response, 200);
        }else{
            return response()->json('Erro e-mail e/ou senha incorretos.', 500);
        }
}
    protected function getModalInserNewAddressUser(){
        return view('app.modals.modalInserNewAddressUser');
    }
    protected function storageNewAddressUser(Request $request){

        return Address::insetNewAddressUser($request->only('user_id'), $request->except('user_id'));
    }
    protected function sendOrderUser(Request $request){
        
        return $order = OrderController::getOredsUser(\Cart::getContent(), $request->only('credcard', 'money', 'pix'), $request->only('address') );
        
    }
}
