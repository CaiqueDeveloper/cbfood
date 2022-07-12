<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingCompany extends Model
{
    use HasFactory;
    protected $table = 'setting_company';
    protected $fillable = ['company_id','slug_url','primaryColor','secondColor','hasDelivery', 'hasOpeneed'];

    public function image(){
        
        return $this->morphMany(Images::class, 'imagebleMorph');
    }
    protected static function getPictureSettingCompany($company_id){
        $settingCompany = SettingCompany::find($company_id);
        if(!$settingCompany)
            return response()->json('Opss! algo deu errado, não encotramos o usuario informado.', 400);
            $image = $settingCompany->image;
        if(!$image)
            return response()->json('Opss! algo deu errado, não encotramos o nenhum endereço para esse usuario.', 400);
            return $image;
    }
    protected static function getCompanyUsingSlug($slug){

        $company_id = SettingCompany::where('slug_url',$slug)->value('company_id');
        return Company::getInfoCompany($company_id);
        
    }
    public function company(){

        return $this->belongsTo(Company::class);
    }
}
