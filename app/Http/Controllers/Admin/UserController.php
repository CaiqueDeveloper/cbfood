<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StorageAddressRequest;
use App\Http\Requests\StorageUserRequester;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Images;
use App\Models\Profile;
use App\Models\ProfilesUser;
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
    public function index(){
        return view('panel.user.index');
    }
    protected function showModalRegisterUser(){
        $profiles = Profile::whereNotIn('id', [5])->get();
        return view('panel.modals.user.modalRegisterUser', compact('profiles'));
    }
    protected function showModalUpdateUser($id){
        $user = User::find($id);
        return view('panel.modals.user.modalUpdateUser', compact('user', 'id'));
    }
    protected function showModalUpdateOrInserAddresUser($id){
        $address = User::getAddrressUser($id);
        
        return view('panel.modals.user.modalUpdateOrInserAddresUser', compact('address', 'id'));
    }
    protected function showModalUpdatePassword($id){;
        
        return view('panel.modals.user.modalUpdatePassword', compact('id'));
    }
    protected function storageUser(StorageUserRequester $request){
       if(self::storage($request->all())){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    protected function getInfoUserLogged (){

        $response = User::getInfoUserLogged();
        return response()->json($response, 200);
    }
    protected function getProfile(){
        return view('panel.user.profile');
    }
    protected function updateUserFolks(UpdateUserRequest $request){
       
        if($request->only('user_id') == null){
            $id = Auth::user()->id;
            $data = $request->all();
        }else{
            $id = $request->only('user_id');
            $data = $request->except('user_id');
        }
        if(User::where('id', $id)->update($data)){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    protected function userChangePassword(ChangePasswordRequest $request){
        
        if($request->only('user_id') == null){
            $id = Auth::user()->id;
        }else{
            $id = $request->only('user_id');
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
    public function deleteUser($id){

        $user = User::find($id);
        if($user->delete()){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 400);
        }
    }
    public function storage($data){
       
        $user = [];
        ($data['profile'] != null) ? $user['company_id'] = auth()->user()->company->id : $user['company_id'] = null;
        $user['name'] = $data['name'];
        $user['email'] = $data['email'];
        $user['number_phone'] = $data['number_phone'];
        $user['password'] = Hash::make($data['password']);
        $user_id = User::create($user)->id;
        if($data['profile'] != null){
            ProfilesUser::create(['profile_id'=>$data['profile'],'user_id' => $user_id,]);
            $user['company_id'] = auth()->user()->company->id;
        }
        
        
        return $user_id ;

    }
    protected function getUsers(){

        return response()->json(User::where('company_id', auth()->user()->company_id)->get(), 200);
    }
   
}
