<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable  = ['user_id','product_id','typePromotion', 'typeDecount', 'descount','periodStart', 'periodEnd'];

    protected static function storage($data){
        $productId = [];
        switch($data['type_promotion']){
            case 'category':    
                foreach($data['select-type-promotion'] as $d){
                    foreach(Product::where('category_id', $d)->where('status',1)->get() as $productCategory){
                        $productId['product_id'][] = $productCategory->id;
                    }
                }
            break;
            case 'product':
                foreach($data['select-type-promotion'] as $d){
                    $productId['product_id'][] = $d;
                }
            break;
            case 'store':
                foreach(Product::getAllProductCompany(auth()->user()->company_id) as $productsCompany){
                    $productId['product_id'][] = $productsCompany->id;
                }
            break;
            default:
                return response()->json(['status' => 400, 'message' => 'Type Item not maping'], 400);
            break;
       }

       foreach($productId['product_id'] as $product_id){

           Promotion::updateOrCreate(
            [
                'product_id' => $product_id,
                'typePromotion' => $data['type_promotion'],
            ],
            [
                'user_id' => auth()->user()->id,
                'product_id' => $product_id,
                'typePromotion' => $data['type_promotion'],
                'typeDecount' => $data['type_descount'],
                'descount' => $data['discount'],
                'periodStart' => $data['periodStart'],
                'periodEnd' => $data['periodEnd'],
           ]);
       }
       return true;
    }
}
