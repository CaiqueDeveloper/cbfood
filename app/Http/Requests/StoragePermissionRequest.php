<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoragePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
           'name' => 'required|min:3|max:20|unique:modules',
           'label' => 'required|min:3|max:100',
           'menu_name' => 'max:100',
           'url' => 'unique:modules'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatorio.',
            'name.unique' => 'Já existe uma permissão/módulo com esse nome, por favor tente outro nome.',
            'url.unique' => 'Essa url já está sendo usada por outro módulo',
            'name.min' => 'O campo nome não pode ter menos de (3) caracteres.',
            'name.max' => 'O campo nome não pode ter mais de (20) caracteres.',
            'label.required' => 'O campo label é obrigatorio.',
            'label.min' => 'O campo label não pode ter menos de (3) caracteres.',
            'label.max' => 'O campo label não pode ter mais de (20) caracteres.',
            'menu_name.min' => 'O campo Nome do Menu não pode ter menos de (3) caracteres.',
            'menu_name.max' => 'O campo Nome do Menu não pode ter mais de (20) caracteres.',
        ];
    }
}
