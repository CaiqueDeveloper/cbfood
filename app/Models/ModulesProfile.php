<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulesProfile extends Model
{
    use HasFactory;
    protected  $table = 'modules_profiles';
    protected $fillable = ['module_id', 'profiles_id'];

    protected static function deleteAssociation($profiles_id, $module_id){
        
        return ModulesProfile::where('profiles_id', $profiles_id)
        ->where('module_id', $module_id)
        ->delete();
    }
}
