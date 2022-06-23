<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoragePermissionRequest;
use App\Models\Module;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected function showModalCreateNewPermission(){
        return view('panel.modals.permissions.modalCreateNewPermission');
    }
    protected function storagePermission(StoragePermissionRequest $request){
        if(Module::storage($request->all())){
            return response()->json('Parabéns Permissão cadastrada com sucesso!', 200);
        }else{
            return response()->json('Erro ao  Cadastrar a Pemissão.', 500);
        }
    }
    protected function geAllPermissions(){
        return response()->json(Module::all(), 200);
    }
}
