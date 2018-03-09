<?php

namespace App\Http\Requests\Maintenance\Certificate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->userType == 1? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'iso_name' => 'required|unique:certificates,iso_name,'.$this->get('id')
        ];
    }
}
