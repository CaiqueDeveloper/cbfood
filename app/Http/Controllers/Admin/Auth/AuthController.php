<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\UltilsController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorageCompanyRequest;
use App\Http\Requests\StorageUserRequester;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\SettingCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\EventListener\ValidateRequestListener;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function logout(){
        Auth::logout();
        return redirect('/admin/dashboard');
    }
    public function register(){
        
        return view('auth.requestFreeDemo');
    }
    public function actionLogin(Request $request){

        
        $credentials = $request->only('email', 'password');
        $auth = Auth::attempt($credentials);
        if(!$auth){
           return response()->json(['alert' => 'E-mail e/ou Senha incorreto !'], 500);
        }

        if(auth()->user()->status){
            $company = Company::isActive(auth()->user()->company_id);

            if($company[0]['status']){
                $route = User::redirectUserBasedOnProfileRoute(auth()->user()->id);
                return response()->json(['redirectRoute' =>  $route], 200);
            }else{
                return response()->json(['alert' => 'Opss! Notamos que a empresa que você está tentando logar se encontra inativa. 
                Por favor entre em contato com nosso suporte técnico. <strong>suporte@cbfood.com.br<strong>'], 500);
            }
        }else{
            return response()->json(['alert' => 'Opss ! Usuário não se encontra ativo. Por favor entre em contato com nosso suporte técnico.<strong>suporte@cbfood.com.br<strong>'], 500);
        }
        
        
    }
    public function storage(Request $request){
        
        $response = ['error' => ''];
        
        // validator
        $validatorUser = self::validatorDataUser($request->except(['company_name', 'cnpj', 'slug_url']));
        $validatorCompany = self::validatorDataCompany($request->only(['company_name', 'cnpj']));

        if($validatorUser->fails()){
            $response['errors'] =  $validatorUser->errors();
            return response()->json($response, 500);
        }
        if($validatorCompany->fails()){
            $response['errors'] =  $validatorCompany->errors();
            return response()->json($response, 500);
        }

        // mounted data

        $user = [];
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['password'] = Hash::make($request->password);
     
        $company = [];
        $company['name'] = $request->company_name;
        $company['cnpj'] = preg_replace('/[^0-9]/', '',$request->cnpj);

        $company_id = Company::insertGetId($company);
        $user['company_id'] = $company_id;
        $user_id = User::insertGetId($user);
        
        $credentials = $request->only('email', 'password');

        if(isset($user_id) && isset($company_id)){

            CompanyUser::insert(['user_id' => $user_id, 'company_id' => $company_id]);
            SettingCompany::insert(['company_id' => $company_id, 'slug_url' => UltilsController::generateSlug($request->company_name)]);

            if(Auth::attempt($credentials)){
                
                $response['user'] = User::find(Auth::user()->id)->get();
                $response['user']['company'] = Company::find(Auth::user()->company_id)->get();
                return response()->json($response, 200);
            }else{
                return response()->json('Erro e-mail e/ou senha incorretos.', 500);
            }
        }


    }
    private static function validatorDataUser($data){
       return Validator::make($data, 
        [
            'name' => 'required|min:5|max:100',
            'email' => 'required|email',
            'password'=>'required|min:8|max:12',
            'password_confirmation'=>'required|min:8|max:12|same:password',
        ],
        [
            'name.required' => 'O campo nome é obrigatorio.',
            'name.min' => 'O campo nome é não pode ter menos de (5) caracter.',
            'name.max' => 'O campo nome é excedeu a quantidade maxima de (100) caracter.',
            'email.required' => 'O campo email é obrigatorio.',
            'email.email' => 'O email não é um email valido.',
            'password.required' => 'O campo senha é obrigatorio',
            'password.min' => 'O campo senha não pode ter menos que (8) caracter',
            'password.max' => 'O campo senha não pode ter mais que (12) caracter',
            'password_confirmation.required' => 'O campo confirmação da senha é obrigatorio',
            'password_confirmation.min' => 'O campo confirmação da senha não pode ter menos que (8) caracter',
            'password_confirmation.max' => 'O campo confirmação da senha não pode ter mais que (12) caracter',
            
        ]
        );
    }
    private static function validatorDataCompany($data){
        return Validator::make($data, 
        [
            'company_name' => 'required|min:5|max:100',
            'cnpj' =>  'max:18'
        ],
        [
            'company_name.required' => 'O campo nome é obrigatorio.',
            'company_name.min' => 'O campo nome é não pode ter menos de (5) caracter.',
            'company_name.max' => 'O campo nome é excedeu a quantidade maxima de (100) caracter.',
            'cnpj.max' => 'O campo cnpj não pode ter maix que (18) caracter',
            
        ]
        );
    }
}
