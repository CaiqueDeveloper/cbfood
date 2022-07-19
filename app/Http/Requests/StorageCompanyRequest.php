<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorageCompanyRequest extends FormRequest
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
            //'email' => 'email',
            'cnpj' => 'max:22',
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
            'cnpj.max' => 'O campo cnpj não pode ter mais que (22) caracter',
            
        ];
    }
}
