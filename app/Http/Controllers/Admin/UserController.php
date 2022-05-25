<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StorageAddressRequest;
use App\Http\Requests\StorageUserRequester;
use App\Models\Address;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Images;
use App\Models\User;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
class UserController extends Controller
{

    protected function getInfoUserLogged (){

        $response = User::getInfoUserLogged();
        return response()->json($response, 200);
    }
    protected function getProfile(){
        return view('panel.user.profile');
    }
    protected function updateUserFolks(StorageUserRequester $request, $id = null){
        if($id == null){
            $id = Auth::user()->id;
        }

        if(User::where('id', $id)->update($request->all())){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    protected function userChangePassword(ChangePasswordRequest $request, $id = null){
        if($id == null){
            $id = Auth::user()->id;
        }
      
        $password = Hash::make($request->password);
        if(User::where('id', $id)->update(['password' => $password])){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    public function updateOrInserAddressUser(StorageAddressRequest $request){

        $id = $request->only('user_id');
        $storageAddress = Address::storageAddressUser($id['user_id'], $request->all());
        if($storageAddress){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    public function storage($data){
        
        $user = [];
        $user['name'] = $data['name'];
        $user['email'] = $data['email'];
        $user['number_phone'] = $data['number_phone'];
        $user['password'] = Hash::make($data['password']);
        return User::create($user);

    }
   
}
