<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getOredsUser($orders, $paymentMethod, $address){
      $address_id = 0;
       $auxOrder = $orders->first();
       $payment = '';
       //dd($auxOrder);
       if(isset($paymentMethod['money'])){
           $payment = $paymentMethod['money'];
       }else{
            $payment = $paymentMethod['credcard'];
       }
       if(isset($address['address'])){
           $address_id = $address['address'];
       }else{
           $address_id = $address;
       }
       $orderUser =  [];
       $orderUser['company_id'] = $auxOrder->attributes->company_id;
       $orderUser['user_id'] = Auth::user()->id;
       $orderUser['address_id'] = $address_id;
       $orderUser['payment_method'] = $payment;
       $orderUser['delivery_price'] = 0;
       $orderUser['price_total'] = \Cart::getTotal();
       $orderInsert = Order::create($orderUser);

       $additional_id = '';
       foreach($orders as  $order){
           if(sizeof($order->attributes->additionalsIds) > 0){
                $additional_id = implode(',', $order->attributes->additionalsIds);
           }
           OrderProduct::insert([
               'orders_id' => $orderInsert->id,
               'products_id' => $order->attributes->product_id,
               'price' => $order->price,
               'quantity' => $order->quantity,
               'sizeText' => ($order->attributes->sizeText != null) ? $order->attributes->sizeText : "",
               'additional_id' => (sizeof($order->attributes->additionalsIds) > 0) ? $additional_id : '',
               'observation' => '',
           ]);
       }
       \Cart::clear();
       return true;
    }   
}
