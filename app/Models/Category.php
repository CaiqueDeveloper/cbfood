<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function category_morph(){ 

        return $this->morphTo();
    }
    
    public function storageCategryCompany($company_id, $data){
        $company = Company::find($company_id);
        return $company->category()->create($data);
    }
    protected static function getAllCategoryCompany(){
        return Company::find(auth()->user()->company_id)->category()->groupBy('categories.name')->select('categories.id','categories.name')->get();
    }
}
