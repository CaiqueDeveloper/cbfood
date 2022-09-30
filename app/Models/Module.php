<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'label', 'url', 'menu_name', 'icon_class', 'hasModules', 'order_list'];
    protected static function storage($data){
        
        $order_list = Module::where('menu_name', $data['menu_name'])->first();
        $data['order_list'] = $order_list->order_list;
        return Module::create($data);
    }
    protected static function updatePermission($permission_id, $data){
        return Module::where('id', $permission_id)->update($data);
    }
    public function profiles(){
        return $this->belongsToMany(Profile::class);
    }
}
