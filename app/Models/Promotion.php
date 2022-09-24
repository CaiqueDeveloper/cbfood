<?php

namespace App\Models;

use App\Http\Controllers\Admin\UltilsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable  = ['user_id','product_id','typePromotion', 'typeDecount', 'descount','periodStart', 'periodEnd'];

    public function productsPromotions(){

        return $this->hasMany(PromotionProducts::class);
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
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
       $promotion_id = Promotion::updateOrCreate(
        [
            'user_id' => auth()->user()->id,
            'typePromotion' => $data['type_promotion'],
            'typeDecount' => $data['type_descount'],
            'descount' => $data['discount'],
            'periodStart' => $data['periodStart'],
            'periodEnd' => $data['periodEnd'],
        ],
        [
            'user_id' => auth()->user()->id,
            'typePromotion' => $data['type_promotion'],
            'typeDecount' => $data['type_descount'],
            'descount' => $data['discount'],
            'periodStart' => $data['periodStart'],
            'periodEnd' => $data['periodEnd'],
        ]
       )->id;
       foreach($productId['product_id'] as $product_id){

           PromotionProducts::create(
            [
                'product_id' => $product_id,
                'promotion_id' =>  $promotion_id,
            ],
            [
                'product_id' => $product_id,
                'promotion_id' =>  $promotion_id,
           ]);
       }
       return true;
    }

    protected function getData(){
        
        return self::mountedDataFromTable(Promotion::with(['productsPromotions.product', 'user'])->get());
    } 
    private function mountedDataFromTable($data){

        $arr = [];
        foreach($data as $key => $d){
           $arr[$key]['id'] = $d->id;
           $arr[$key]['user'] = $d->user->name;
           switch($d->typePromotion){
                case 'store':
                    $arr[$key]['typePromotion'] = 'Loja';
                break;
                case 'product':
                    $arr[$key]['typePromotion'] = 'Produto';
                break;
                case 'category':
                    $arr[$key]['typePromotion'] = 'Categoria';
                break;
            }
           
           $arr[$key]['typeDecount'] = ( $d->typeDecount == 'direct_discount') ? 'Desconto Direto' : 'Porcentagem' ;
           if($d->typeDecount == 'direct_discount'){
                $arr[$key]['descount'] = UltilsController::moeny($d->descount);
           }else{
                $arr[$key]['descount'] = UltilsController::percentage($d->descount);
           }
           $arr[$key]['periodStart'] = $d->periodStart;
           $arr[$key]['periodEnd'] = $d->periodEnd;
           $arr[$key]['status'] = ($d->status) ? 'Promoção Ativa' : 'Promoção Desativada';
           foreach($d->productsPromotions as $key_a => $productsPomotion){

                $arr[$key]['collaps'][$key_a]['product_id'] = $productsPomotion->product_id;
                $arr[$key]['collaps'][$key_a]['promotion_id'] = $productsPomotion->promotion_id;
                $arr[$key]['collaps'][$key_a]['product_name'] = $productsPomotion->product->name;
                $arr[$key]['collaps'][$key_a]['status'] = ($productsPomotion->promotion_id) ? 'Promoção Ativa' : 'Promoção Desativada';
           }
        }
        return $arr;
    }
}
