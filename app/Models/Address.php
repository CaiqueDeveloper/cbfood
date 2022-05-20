<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['states', 'zipe_code', 'city', 'distric', 'road', 'number'];
    protected  $table = 'address';

    public function addres_morph(){
        
        return $this->morphTo();
    }

    public function storageAddressUser($user_id, $data){
       
        $user = User::find($user_id);
        return $user->address()->updateOrCreate(['addres_morph_id' => $user_id], $data);
    }
    public function storageAddressCompany($company_id, $data){

        $company = Company::find($company_id);
        return $company->address()->updateOrCreate(['addres_morph_id' => $company_id], $data);
    }
}
