<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Images;
use App\Models\SettingCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SebastianBergmann\CodeUnit\FunctionUnit;

class UltilsController extends Controller
{
    public function uploadedFile(Request $request){
        $data = [];
        $hasExiteFiles = '';

        switch($request->type_model){
            case 'user':
                $hasExiteFiles = User::getPictureProfileUser(Auth::user()->id);
            break;
            case 'company':
                $hasExiteFiles = Company::getPictureProfileCompany(Auth::user()->company_id);
            break;
            case 'company_banner':
                $hasExiteFiles = SettingCompany::getPictureSettingCompany(Auth::user()->company_id);
            break;
        }
        
        $fileExist = (isset($hasExiteFiles) && sizeof($hasExiteFiles) >0) ? public_path('profile/'.$hasExiteFiles[0]->path): '';
        $file = $request->file('file');
        $filename= date('YmdHi').$file->getClientOriginalName();
        
        if(file_exists($fileExist)){

            File::delete(public_path('profile/'.$hasExiteFiles[0]->path));
            $file->move(public_path('profile'), $filename);

            $data['path']= $filename;
            
            switch($request->type_model){
                case 'user':
                    $storageFile = Images::storagePictureProfileUser(Auth::user()->id,$data);
                break;
                case 'company':
                    $storageFile = Images::storagePictureProfileCompany(Auth::user()->company_id,$data);
                break;
                case 'company_banner':
                    $storageFile = Images::storagePictureSettingCompany(Auth::user()->company_id, $data);
                break;
            }
            if($storageFile){
                return response()->json('success', 200);
            }else{
                return response()->json('error', 400);
            }
        }else{
            $file->move(public_path('profile'), $filename);
            $data['path']= $filename;

            switch($request->type_model){
                case 'user':
                    $storageFile = Images::storagePictureProfileUser(Auth::user()->id,$data);
                break;
                case 'company':
                    $storageFile = Images::storagePictureProfileCompany(Auth::user()->company_id,$data);
                break;
                case 'company_banner':
                    $storageFile = Images::storagePictureSettingCompany(Auth::user()->company_id, $data);
                break;
            }
            if($storageFile){
                return response()->json('success', 200);
            }else{
                return response()->json('error', 400);
            }
        }
    }
    public static function generateSlug($name){
        
        $slug = Str::slug($name);
        return $slug;
    }    
}
