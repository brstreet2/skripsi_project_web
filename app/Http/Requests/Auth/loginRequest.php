<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'       => 'required|email|regex:/^(?:[^"\'\<>\ㅤ\⠀+])+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/i',
            'password'    => 'required|min:8'

        ];
    }

    /**
     * Get the message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'      => 'Email tidak boleh kosong.',
            'email.email'         => "Format Email salah.",
            'email.regex'         => "Format Email salah.",
            'password.required'   => 'Password tidak boleh kosong.',
            'password.min'        => 'Password minimal 8 karakter.'
        ];
    }
}
