<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalItems extends Model
{
    use HasFactory;
    protected $fillable = ['additional_id','name', 'description', 'price', 'code', 'status'];
    
    protected static function deleteItemGroupAdditional($itemsAdditional){
       if(sizeof($itemsAdditional) > 0){
            return AdditionalItems::whereIn('id', array_column($itemsAdditional, 'id'))->delete();
       }else{
           return true;
       }
        
    }
}
