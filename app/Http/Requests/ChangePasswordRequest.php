<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
           'password'=>'required|min:8|max:12',
            'password_confirmation'=>'required|min:8|max:12|same:password',
        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'O campo senha é obrigatorio',
            'password.min' => 'O campo senha é não pode ter menos que (8) caracter',
            'password.max' => 'O campo senha é não pode ter mais que (12) caracter',
            'password_confirmation.required' => 'O campo confirmação da senha é obrigatorio',
            'password_confirmation.min' => 'O campo confirmação da senha é não pode ter menos que (8) caracter',
            'password_confirmation.max' => 'O campo confirmação da senha é não pode ter mais que (12) caracter',
        ];
    }
}
