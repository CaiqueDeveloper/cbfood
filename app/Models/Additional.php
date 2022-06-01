<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Additional extends Model
{
    use HasFactory;
    protected $fillable  = ['name'];

    public function aadditional_morph(){
        
        return $this->morphTo();
    }
    public function storageAdditionalCompany($company_id, $data){
        
        $company = Company::find($company_id);
        return $company->additional()->create($data);
    }
    public static function getAllAdditionalsCompany(){

        $company = Company::find(Auth::user()->company_id);
        return $company->additional;
    }
    public function items(){

        return $this->hasMany(AdditionalItems::class);
    }
    protected static function deleteGroupAdditional($additional_id){
        
        $additional = Additional::find($additional_id);
        $itemsAdditional = $additional->items->toArray();
        
        if(AdditionalItems::deleteItemGroupAdditional($itemsAdditional)){
            $additional->delete();
            return true;
        }else{
            return false;
        }
    }
    
}
