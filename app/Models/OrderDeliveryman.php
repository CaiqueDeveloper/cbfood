<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDeliveryman extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','user_id','status'];

    public function orderDatailsDeliveryMen(){
        return $this->belongsTo(Order::class , 'order_id', 'id');
    }
    
}
