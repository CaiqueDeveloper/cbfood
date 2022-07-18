<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorageUserRequester extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email',
            'number_phone' => 'required|max:11',
            'number_phone_alternative' => 'max:11',
            'password'=>'required|min:8|max:12',
            'password_confirmation'=>'required|min:8|max:12|same:password',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatorio.',
            'name.min' => 'O campo nome é não pode ter menos de (2) caracter.',
            'name.max' => 'O campo nome é excedeu a quantidade maxima de (100) caracter.',
            'email.required' => 'O campo email é obrigatorio.',
            'email.email' => 'O email não é um email valido.',
            'number_phone.required' => 'O campo telefone é obrigatorio.',
            'number_phone.digits' => 'O campo telafone não pode ter menos que (11) caracter',
            'number_phone_alternative.digits' => 'O campo telafone alternativo não pode ter menos que (11) caracter',
            'password.required' => 'O campo senha é obrigatorio',
            'password.min' => 'O campo senha é não pode ter menos que (8) caracter',
            'password.max' => 'O campo senha é não pode ter mais que (12) caracter',
            'password_confirmation.required' => 'O campo confirmação da senha é obrigatorio',
            'password_confirmation.min' => 'O campo confirmação da senha é não pode ter menos que (8) caracter',
            'password_confirmation.max' => 'O campo confirmação da senha é não pode ter mais que (12) caracter',
            
        ];
    }
}
