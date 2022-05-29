<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['company_id','user_id','address_id', 'payment_method', 'delivery_price', 'price_total', ];

    public function orderProduct(){
       
        return $this->hasMany(OrderProduct::class, 'orders_id')->with('productOrder');
    }
    public function orderUser(){
       
        return $this->hasMany(User::class,'id', 'user_id');
    }

    protected static function getOrders(){

        $company_id = Auth::user()->company_id;
        return Order::find($company_id)->with('orderProduct','orderUser')->orderBy('orders.created_at', 'desc')->get();
    }
}
