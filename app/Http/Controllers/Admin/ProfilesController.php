<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorageProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Models\ProfilesUser;
use App\Models\User;
use Illuminate\Http\Request;
class ProfilesController extends Controller
{

    public function index(){

        return view('panel.permission.index');
    }
    protected function showModalCreateNewPorifle(){
        return view('panel.modals.profiles.modalCreateNewPorifle');
    }
    protected function storageProfile(StorageProfileRequest $request){

        if(Profile::storage($request->all())){
            return response()->json('Parabéns Perfil Cadatrado Com Sucesso.', 200);
        }else{
            return response()->json('Erro ao Cadastrar esse Perfil.', 200);
        }
    }
    protected function geAllProfiles(){
        
        return response()->json(Profile::all(), 200);
    }
    protected function showModalUpdateProfile($id){
        $profile = Profile::find($id);
        return view('panel.modals.profiles.modalUpdateProfile', compact('profile'));
    }
    protected function updateProfile(UpdateProfileRequest $request){
        if(Profile::updateProfile($request->only('profile_id'), $request->except('profile_id'))){
            return response()->json('Parabéns Perfil Cadatrado Com Sucesso.', 200);
        }else{
            return response()->json('Erro ao Cadastrar esse Perfil.', 200);
        }
    }
    protected function delteProfile($id){
        if(Profile::where('id', $id)->delete()){
            return response()->json('Parabéns Perfil Cadatrado Com Sucesso.', 200);
        }else{
            return response()->json('Erro ao Cadastrar esse Perfil.', 200);
        }
    }
    protected function showModalAllUserAssociateWithProfile($id){
        $users = User::all();
        $profile_id = $id;
        $hasAssociateUserWithProfile = ProfilesUser::all();
        return view('panel.modals.profiles.modalAllUserAssociateWithProfile', compact('users', 'profile_id', 'hasAssociateUserWithProfile'));
    }
}
