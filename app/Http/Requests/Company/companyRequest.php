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
            'longitude'            => 'required',
            'latitude'              => 'required'


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
            'company_name.required'         => 'Mohon isi nama bisnis anda.',
            'company_phone.required'       => 'Mohon isi nomor telepon bisnis anda.',
            'company_spv.required'          => 'Mohon isi email supervisor / penanggung jawab.',
            'company_address.required'      => 'Mohon isi alamat bisnis anda.',
            'company_province.required'     => 'Mohon pilih provinsi asal bisnis anda.',
            'company_city.required'         => 'Mohon pilih kota asal bisnis anda.',
            'company_industry.required'     => 'Mohon pilih industri bisnis anda.',
            'company_size.required'         => 'Mohon isi jumlah karyawan yang anda miliki.',
            'longitude.required'           => 'Mohon pilih lokasi absen',
            'latitude.required'             => 'Mohon pilih lokasi absen',
        ];
    }
}
