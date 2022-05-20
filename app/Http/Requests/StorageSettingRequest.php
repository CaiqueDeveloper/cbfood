<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorageSettingRequest extends FormRequest
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
            'bgColor' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'bgColor.required' => 'O campo estado é obrigatorio.',
            
        ];
    }
}
