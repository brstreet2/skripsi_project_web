<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
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
            'name'        => 'required|regex:/^(?:[^"\'\<>\ㅤ\⠀])+$/i',
            'email'       => 'required|email|regex:/^(?:[^"\'\<>\ㅤ\⠀+])+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/i',
            'password'    => 'required|min:8'

        ];
    }

    /**
	 * Get the message
	 *
	 * @return array
	 */
	public function messages() {
		return [
			'name.required'       => 'Please enter your name.',
            'email.required'      => 'Please enter your email address.',
            'password.required'   => 'Please enter your password.',
            // 'password.min'        => 'You need to input at least 8 characters.'
		];
	}
}
