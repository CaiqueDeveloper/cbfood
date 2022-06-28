<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModulesProfile;
use App\Models\Profile;
use Illuminate\Http\Request;

class ModulesProfileController extends Controller
{
    protected function showModalPermissionAssociationWithProfile($permission_id){
        $profiles = Profile::all();
        $hasAssociationPemmissionWithModule = ModulesProfile::all();
        return view('panel.modals.permissions.modalPermissionAssociationWithProfile', compact('profiles','permission_id','hasAssociationPemmissionWithModule'));
    }
    protected function storageAssociationPermissionWithProfile(Request $request){
        if(ModulesProfile::create($request->all())){
            return response()->json('Parabéns Permissão cadastrada com sucesso!', 200);
        }else{
            return response()->json('Erro ao  Cadastrar a Pemissão.', 500);
        }
    }
    protected function removeAssociationPermissionWithProfile(Request $request){
        
        if(ModulesProfile::deleteAssociation($request->profiles_id, $request->module_id)){
            return response()->json('Parabéns Permissão cadastrada com sucesso!', 200);
        }else{
            return response()->json('Erro ao  Cadastrar a Pemissão.', 500);
        }
    }
}
