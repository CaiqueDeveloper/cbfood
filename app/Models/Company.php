<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email','cnpj', 'phone_number'];

    public function address(){

        return $this->morphMany(Address::class, 'addres_morph');
    }
    public function image(){
        
        return $this->morphMany(Images::class, 'imagebleMorph');
    }
    public function category(){
        
        return $this->morphMany(Category::class, 'category_morph');
    }
    public function additional(){
        
        return $this->morphMany(additional::class, 'additional_morph');
    }
    public function product(){
        
        return $this->morphMany(Product::class, 'product_morph');
    }
    public function settings(){
        
        return $this->hasMany(SettingCompany::class, 'company_id');
    }
    protected static function getAddrressCompany($id){
        $company = Company::find($id);
        if(!$company)
             return response()->json('Opss! algo deu errado, não encotramos o empresa informado.', 400);
             $address = $company->address;
 
        if(!$address)
            return response()->json('Opss! algo deu errado, não encotramos o nenhum endereço para esse empresa.', 400);
            return $address;
    }
    protected static function getPictureProfileCompany($id){
        $company = Company::find($id);
        if(!$company)
             return response()->json('Opss! algo deu errado, não encotramos o usuario informado.', 400);
             $image = $company->image;
 
        if(!$image)
            return response()->json('Opss! algo deu errado, não encotramos o nenhum endereço para esse usuario.', 400);
            return $image;
    }
    protected static function getInfoCompany($company_id){
        
        $data = [];
        $data['company'] = Company::find($company_id);
        $data['company']['address'] = (Company::getAddrressCompany($company_id) != null) ? Company::getAddrressCompany($company_id) : null;
        $data['company']['settings'] = SettingCompany::find($company_id);
        $data['company']['settings']['banner'] = SettingCompany::getPictureSettingCompany($company_id);
        $data['company']['settings']['pictureProfile'] = Company::getPictureProfileCompany($company_id);
        $data['company']['products'] = Product::getAllProductCompany($company_id);


        return $data;
    }
    public function orders(){
        return $this->hasMany(Order::class, 'company_id');
    }
    public function user(){
        return $this->hasMany(User::class, 'company_id');
    }
    public function notify(){
        return $this->hasMany(Notify::class, 'notifiable_id');
    }
    protected static function getCompanyOrder($company_id){
        return Company::where('id', $company_id)->select('companies.name','companies.phone_number')->get();
    }
    public static function isActive($company_id){
        return Company::where('id', $company_id)->select('companies.status')->get();
    }
    public function categories(){

        return $this->hasMany(Category::class, 'category_morph_id', 'id');
    }
}
