<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'label', 'url', 'menu_name', 'icon_class', 'hasModules'];
    protected static function storage($data){
        return Module::create($data);
    }
}
