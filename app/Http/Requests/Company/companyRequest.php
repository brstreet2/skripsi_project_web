<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class companyRequest extends FormRequest
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
            'company_name'          => 'required|regex:/^(?:[^"\'\<>\ㅤ\⠀])+$/i',
            'company_phone'         => 'required',
            'company_spv'           => 'required|email|regex:/^(?:[^"\'\<>\ㅤ\⠀+])+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/i',
            'company_address'       => 'required',
            'company_province'      => 'required',
            'company_city'          => 'required',
            'company_industry'      => 'required',
            'company_size'          => 'required',


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
            'company_name.required'         => 'Please provide a name for your company.',
            'company_phnone.required'       => 'Please provide a phone number for your company.',
            'company_spv.required'          => 'Please provide an email.',
            'company_address.required'      => 'Please provide an address for your company.',
            'company_province.required'     => 'Please select a province for your company.',
            'company_city.required'         => 'Please select a city for your company.',
            'company_industry.required'     => 'Please select an industry of your company.',
            'company_size.required'         => 'Please state how many people are working in your company.',
        ];
    }
}
