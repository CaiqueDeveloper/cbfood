<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable  = ['name','label'];
    
    protected static function storage($data){
        return Profile::create($data);
    }
    protected static function updateProfile($profile_id,$data){
        return Profile::where('id',$profile_id)->update($data);
    }
}
