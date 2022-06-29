<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilesUser;
use Illuminate\Http\Request;

class ProfilesUserController extends Controller
{
    protected function storageAssociateProfileWithUser(Request $request){ 
        if(ProfilesUser::updateOrCreate($request->all())){
            return response()->json('Parabéns Perfil Cadatrado Com Sucesso.', 200);
        }else{
            return response()->json('Erro ao Cadastrar esse Perfil.', 200);
        }
    }
    protected function removeProfileAssociationWithUser(Request $request){ 
       
        $association = ProfilesUser::where('profile_id',$request->profiles_id)->where('user_id', $request->user_id)->get();
       
        if($association[0]->delete()){
            return response()->json('Parabéns Perfil Cadatrado Com Sucesso.', 200);
        }else{
            return response()->json('Erro ao Cadastrar esse Perfil.', 200);
        }
    }
}
