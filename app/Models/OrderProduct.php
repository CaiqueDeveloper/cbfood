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
}
