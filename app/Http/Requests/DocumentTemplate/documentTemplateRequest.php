<?php

namespace App\Http\Requests\DocumentTemplate;

use Illuminate\Foundation\Http\FormRequest;

class documentTemplateRequest extends FormRequest
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
            'document_name'     => 'required|regex:/^(?:[^"\'\<>\ㅤ\⠀])+$/i',
            'description'       => 'required',
            'content'           => 'required'

        ];
    }

    /**
	 * Get the message
	 *
	 * @return array
	 */
	public function messages() {
		return [
			'document_name.required'       => 'Please provide a name for the document.',
            'email.required'               => 'Please provide a short description for the document.',
            'content.required'             => 'Please design the template.',
		];
	}
}
