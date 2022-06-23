<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorageProfileRequest;
use App\Models\Profile;
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
}
