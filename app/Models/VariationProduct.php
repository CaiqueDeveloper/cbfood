<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationProduct extends Model
{
    use HasFactory;
    protected  $table = 'variation_product';
    protected $fillable = ['product_id', 'variationName', 'variationType', 'variationPrice'];

    protected static function storageVariationProduct($product_id,  $arrVariationProduct){
       // dd($arrVariationProduct);

        foreach($arrVariationProduct as $variation){
            if($variation['variationName'] != null && $variation['variationType'] != null && $variation['variationPrice'] != null){
                VariationProduct::updateOrCreate(
                    ['id' => $variation['variation_id']],
                    [
                    'product_id' => $product_id,
                    'variationName' =>  $variation['variationName'],
                    'variationType' =>  $variation['variationType'],
                    'variationPrice' => $variation['variationPrice'],
                ]);
            }
        }
        return true;
           
    }
}
