<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'description', 'price', 'canPrice', 'hasVariations'];

    public function prduct_morph(){
        
        return $this->morphTo();
    }
    public function image(){
        
        return $this->morphMany(Images::class, 'imagebleMorph');
    }
    public static function storageProductCompany($company_id, $product_id, $data, $images, $additinalIds, $arrVariationProduct){
   
      
        $company = Company::find($company_id);
        $product_id = $company->product()->updateOrCreate(['id'=> $product_id],$data)->id; 
        $sotorageAdditional = AdditionalProduct::relatingProducttoAdditionals($product_id,$additinalIds);
        $storageVariation = VariationProduct::storageVariationProduct($product_id, $arrVariationProduct);
        $storageImages = Images::storagePhotoProduct($product_id,$images);
        
        if($sotorageAdditional && $storageVariation && $storageImages){
            return  $product_id;
        }else{
            return false;
        }
    }
    protected static function getAllProductCompany($id, $withPaginate = true){
        
        $company = Company::find($id);
        if(!$company)
             return response()->json('Opss! algo deu errado, não encotramos o empresa informado.', 400);
             if($withPaginate == false){
                $products = $company->product()->where('status',1)->groupBy('products.name')->select('products.id', 'products.name')->get();
             }else{
                $products = $company->product()->where('status',1)->paginate(50);
             }
             
        if(!$products)
            return response()->json('Opss! algo deu errado, não encotramos o nenhum endereço para esse empresa.', 400);
            return $products;
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function images(){
        return $this->hasMany(Images::class,'imagebleMorph_id');
    }
    public function additionalsProduct(){
        return $this->hasMany(AdditionalProduct::class, 'product_id');
    }
    public function variations(){
        return $this->hasMany(VariationProduct::class, 'product_id');
    }
    public static function deleteProduct($id){

        $product = Product::find($id);

        if(sizeof($product->images) > 0){
           $images = $product->images;
            Images::deleteImagesProduct($images);
        }
        if(sizeof($product->additionalsProduct) > 0){
            $product->additionalsProduct()->delete();
        }
        if(sizeof($product->variations) > 0){
            $product->variations()->delete();
        }

        if($product->delete()){
            return true;
        }else{
            return false;
        }
    }
}
