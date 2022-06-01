<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'order_products';
    protected $fillable = ['order_id','product_id','observation', 'additional_id', 'quantity', 'price', 'sizeText'];

    public function productOrder(){
       
        return $this->hasMany(Product::class, 'id','products_id');
    }
    public static function storageOrderProduct($order_id, $orders){

        $additional_id = '';

        foreach($orders as  $order){
            if(sizeof($order->attributes->additionalsIds) > 0){
                    $additional_id = implode(',', $order->attributes->additionalsIds);
            }
            OrderProduct::insert([
                'orders_id' => $order_id,
                'products_id' => $order->attributes->product_id,
                'price' => $order->price,
                'quantity' => $order->quantity,
                'sizeText' => ($order->attributes->sizeText != null) ? $order->attributes->sizeText : "",
                'additional_id' => (sizeof($order->attributes->additionalsIds) > 0) ? $additional_id : '',
                'observation' => $order->attributes->observation,
            ]);
        }

        return true;
    }
    
}
