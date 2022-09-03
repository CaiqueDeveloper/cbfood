<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoragePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Module;
use App\Models\ModulesProfile;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct() {
    
        $this->middleware('auth');
   }
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
    protected function showModalUpdatePermission($id){
        $permission = Module::find($id);
        return view('panel.modals.permissions.modalUpdatePermission', compact('permission'));
    }
    protected function updatePermission(UpdatePermissionRequest $request){
        if(Module::updatePermission($request->only('permission_id'), $request->except('permission_id'))){
            return response()->json('Parabéns Permissão cadastrada com sucesso!', 200);
        }else{
            return response()->json('Erro ao  Cadastrar a Pemissão.', 500);
        }
    }
    protected function deletePermission($id){
        if(Module::where('id', $id)->delete()){
            return response()->json('Parabéns Permissão cadastrada com sucesso!', 200);
        }else{
            return response()->json('Erro ao  Cadastrar a Pemissão.', 500);
        }
    }
    
}
