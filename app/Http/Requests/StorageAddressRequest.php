<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorageAddressRequest extends FormRequest
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
            'states' => 'required|max:2',
            'zipe_code' => 'required|max:9',
            'city' => 'required',
            'distric' => 'required',
            'road' => 'required',
            'number' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'states.required' => 'O campo estado é obrigatorio.',
            'states.max' => 'O campo estado é excedeu a quantidade maxima de (2) caracter.',
            'zipe_code.required' => 'O campo cep é obrigatorio.',
            'zipe_code.max' => 'O cep não pode ter menos que (11) caracter.',
            'city.required' => 'O campo cidade é obrigatorio.',
            'distric.required' => 'O campo bairro é obrigatorio.',
            'road.required' => 'O campo rua é obrigatorio.',
            'number.required' => 'O campo número é obrigatorio.',
            'number.integer' => 'O valor informado no campo número não de ser uma strig.',
            
        ];
    }
}
