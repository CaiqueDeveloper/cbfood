<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class Images extends Model
{
    use HasFactory;
    protected $fillable = ['path'];

    public function imagebleMorph(){
        
        return $this->morphTo();
    }
    public static function storagePictureProfileUser($user_id, $data){

        $user = User::find($user_id);
        return $user->image()->updateOrCreate(['imagebleMorph_id' => $user_id],$data);
    }
    public static function storagePictureProfileCompany($company_id, $data){

        $company = Company::find($company_id);
        return $company->image()->updateOrCreate(['imagebleMorph_id' => $company_id], $data);
    }
    public static function storagePictureSettingCompany($company_id, $data){

        $company = SettingCompany::find($company_id);
        return $company->image()->updateOrCreate(['imagebleMorph_id' => $company_id], $data);
    }
    public static function storagePhotoProduct($product_id, $images){
        
        $product = Product::find($product_id);
       if(isset($images)){
        foreach($images as $image){

            $filename = date('YmdHi').$image->getClientOriginalName();
            $image->move(public_path('product_photo'), $filename);

            $product->image()->create(['path' => $filename]);
        }
       }
        return $product;
    }
    protected static function deleteImagesProduct($images){
        foreach($images as $image){
            File::delete(public_path('product_photo/'.$image->path));
        }
        return true;
    }
    protected static function deleteImageProduct($image_id){
        $image = Images::find($image_id);
        File::delete(public_path('product_photo/'.$image->path));
        if($image->delete()){
            return true;
        }else{
            return false;
        }
    }
   
}
