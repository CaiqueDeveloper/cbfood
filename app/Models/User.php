<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name','email','company_id','number_phone','number_phone_alternative','password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function address(){

        return $this->morphMany(Address::class, 'addres_morph');
    }
    public function image(){
        
        return $this->morphMany(Images::class, 'imagebleMorph');
    }
     //ACL DA APLICAÇÃO
     public function profiles(){
        return $this->belongsToMany(Profile::class);
    }
    public function hasModule(Module $module){
        return $this->hasAnyProfiles($module->profiles);
    }
    public function hasAnyProfiles($profiles){
        if(is_array($profiles) || is_object($profiles)){
            return !!$profiles->intersect($this->profiles)->count();
        }
        return $this->profiles->contains('name', $profiles->name);
    }
    protected function getInfoUserLogged(){
        
        $data = [];
        
        $data['user'] = Auth::user();
        if(Auth::user()->company_id != null){
            $data['user']['address'] = (self::getAddrressUser(Auth::user()->id) != null) ? self::getAddrressUser(Auth::user()->id) : null;
            $data['user']['pictureProfile'] = self::getPictureProfileUser(Auth::user()->id);
            $data['user']['company'] = Company::find(Auth::user()->company_id);
            $data['user']['company']['address'] = (Company::getAddrressCompany(Auth::user()->company_id) != null) ? Company::getAddrressCompany(Auth::user()->company_id) : null;
            $data['user']['company']['pictureProfile'] = (sizeof(Company::getPictureProfileCompany(Auth::user()->company_id)) > 0) ? Company::getPictureProfileCompany(Auth::user()->company_id) : null;
            $data['user']['company']['settings'] = SettingCompany::find(Auth::user()->company_id);
            $data['user']['company']['settings']['banner'] = (sizeof(SettingCompany::getPictureSettingCompany(Auth::user()->company_id)) > 0) ? SettingCompany::getPictureSettingCompany(Auth::user()->company_id) : null;
            $data['user']['companies'] = Auth::user()->companies;
            $data['user']['designMenu'] = self::designMenuBasedonUserProfiles();
        }
        
        return $data;
    }

    protected static function getAddrressUser($id){
        $user = User::find($id);
        if(!$user)
             return response()->json('Opss! algo deu errado, não encotramos o usuario informado.', 400);
             $address = $user->address;
 
        if(!$address)
            return response()->json('Opss! algo deu errado, não encotramos o nenhum endereço para esse usuario.', 400);
            return $address;
    }
    protected static function getPictureProfileUser($id){
        $user = User::find($id);
        if(!$user)
             return response()->json('Opss! algo deu errado, não encotramos o usuario informado.', 400);
             $image = $user->image;
 
        if(!$image)
            return response()->json('Opss! algo deu errado, não encotramos o nenhum endereço para esse usuario.', 400);
            return $image;
    }
    public function companies(){
        return $this->belongsToMany(Company::class);
    }
    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function orders(){

        return $this->hasMany(Order::class, 'user_id');
    }
    public function ordersDeliverymen(){

        return $this->hasMany(OrderDeliveryman::class, 'user_id');
    }
    protected static function getUserOrder($user_id){
        return User::where('id', $user_id)->select('users.name','users.number_phone')->get();
    }
    protected static function designMenuBasedonUserProfiles(){
        
        $modules = DB::table('profile_user')
        ->join('module_profile', 'module_profile.profile_id', '=', 'profile_user.profile_id')
        ->join('modules', 'modules.id', '=', 'module_profile.module_id')
        ->where('profile_user.user_id', auth()->user()->id)
        ->where('modules.hasModules', '!=', '0')
        ->select('modules.name', 'modules.url', 'modules.label', 'modules.menu_name', 'modules.icon_class')
      //  ->groupBy('module_profile.module_id')
	    ->orderBy('modules.order_list', 'asc')
        ->get();

        $groupedModules = array();
        foreach($modules as $module){
            $index = array_search($module->menu_name, array_column($groupedModules, 'menu'));
            if($index === false){
                array_push($groupedModules, ['menu' => $module->menu_name, 'iconClass' => $module->icon_class, 'subMenu' => array($module)]);
            }else{
                array_push($groupedModules[$index]['subMenu'], $module);

            }
        }
        return $groupedModules;
    }
    protected static function redirectUserBasedOnProfileRoute($id_user){

        $modules = DB::table('profile_user')
        ->where('user_id', '=', $id_user)
        ->join('module_profile', 'module_profile.profile_id','=', 'profile_user.profile_id')
        ->join('modules', 'modules.id','=', 'module_profile.module_id' )
        ->select('modules.name', 'modules.url')
        ->orderBy('modules.id','asc')
        ->first();

        return $modules->url != null ? $modules->url : "/" ;
	}

   
}
