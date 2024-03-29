<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        
        return response()->json($cartItems, 200);
    }
    public function priceCart()
    {
      
        $priceCart = \Cart::getTotal();
        
        return response()->json(number_format($priceCart,2,",","."), 200);
    }


    public function addToCart(Request $request){
        
       \Cart::add([
            'id' => $request[0]['identifier'],
            'name' => $request[0]['name'],
            'price' => $request[0]['price'],
            'quantity' => $request[0]['quatity'],
            'attributes' => [
                'product_id' => $request[0]['product_id'],
                'company_id' => $request[0]['company_id'],
                'image' => $request[0]['image'],
                'additionalsIds' => $request[0]['itemsAdditional'],
                'sizeId' => (isset($request[0]['sizeId'])) ? $request[0]['sizeId']: '',
                'sizeText' => (isset($request[0]['sizeText'])) ? $request[0]['sizeText'] : '',
                'observation' => $request[0]['observation'],
            ]
        ]);

        return response()->json('Product is Added to Cart Successfully !',200);
    }

    public function updateCart(Request $request)
    {
        
       \Cart::update(
            $request->product_id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quatity
                ],
            ]
        );
        $priceCart = \Cart::getTotal();
        return response()->json(['quantity' => $request->quatity, 'totalPrice' => number_format($priceCart,2,",",".")],200);
    }

    public function removeCart($id)
    {
       \Cart::remove($id);
       return response()->json('Product is Added to Cart Successfully !',200);
    }

    public function clearAllCart()
    {
       \Cart::clear();
       return response()->json('Product is Added to Cart Successfully !',200);
    }

}
