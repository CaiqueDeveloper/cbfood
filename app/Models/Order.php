<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['company_id','user_id','address_id', 'payment_method', 'delivery_price', 'price_total', ];

    public function orderProduct(){
       
        return $this->hasMany(OrderProduct::class, 'orders_id');
    }
}
