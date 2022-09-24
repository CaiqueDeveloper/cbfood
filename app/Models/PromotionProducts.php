<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionProducts extends Model
{
    use HasFactory;
    protected $fillable  = ['product_id','promotion_id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
