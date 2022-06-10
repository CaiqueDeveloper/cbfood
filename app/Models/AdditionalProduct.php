<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalProduct extends Model
{
    use HasFactory;
    protected  $table = 'additional_product';
    protected $fillable = ['additional_id', 'product_id'];
    public $timestamps = false;

    protected static function relatingProducttoAdditionals($product_id,$additinalIds){
       if(sizeof($additinalIds) > 0){
           foreach($additinalIds['additionals'] as $key => $value){
               AdditionalProduct::updateOrCreate(['additional_id' => $value, 'product_id' => $product_id],['additional_id' => $value, 'product_id' => $product_id]);
           }
           return true;
       }
       
       return true;
    }
}
