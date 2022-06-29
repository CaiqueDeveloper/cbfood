<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulesProfile extends Model
{
    use HasFactory;
    protected  $table = 'module_profile';
    protected $fillable = ['module_id', 'profile_id'];

    protected static function deleteAssociation($profiles_id, $module_id){
        
        return ModulesProfile::where('profile_id', $profiles_id)
        ->where('module_id', $module_id)
        ->delete();
    }
}
