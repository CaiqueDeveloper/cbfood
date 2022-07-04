<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|min:5|max:100',
            'email' => 'required|email',
            'number_phone' => 'max:11',
            'number_phone_alternative' => 'max:11',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatorio.',
            'name.min' => 'O campo nome é não pode ter menos de (5) caracter.',
            'name.max' => 'O campo nome é excedeu a quantidade maxima de (100) caracter.',
            'email.required' => 'O campo email é obrigatorio.',
            'email.email' => 'O email não é um email valido.',
            'number_phone.required' => 'O campo telefone é obrigatorio.',
            'number_phone.digits' => 'O campo telafone não pode ter menos que (11) caracter',
            'number_phone_alternative.digits' => 'O campo telafone alternativo não pode ter menos que (11) caracter'
            
        ];
    }
}
