<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingCompany extends Model
{
    use HasFactory;
    protected $table = 'setting_company';
    protected $fillable = ['company_id','slug_url','primaryColor','secondColor','hasDelivery', 'hasOpeneed', 'deliveryPrice', 'limit_send_delivery'];

    public function image(){
        
        return $this->morphMany(Images::class, 'imagebleMorph');
    }
    protected static function getPictureSettingCompany($company_id){
        $settingCompany = SettingCompany::where('company_id',$company_id)->get();
       // dd($settingCompany);
        if(!$settingCompany)
            return response()->json('Opss! algo deu errado, não encotramos o usuario informado.', 400);
            $image = $settingCompany[0]->image;
        if(!$image)
            return response()->json('Opss! algo deu errado, não encotramos o nenhum endereço para esse usuario.', 400);
            return $image;
    }
    protected static function getCompanyUsingSlug($slug){

        $company_id = SettingCompany::where('slug_url',$slug)->select('company_id')->get();
        return Company::getInfoCompany($company_id);
        
    }
    public function company(){

        return $this->belongsTo(Company::class);
    }
}
