<?php

namespace App\Http\Requests\Maintainance\Manpower;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManpowerType extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->userType == 1 ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|unique:client_manpower_types,type,'.$this->get('id')
        ];
    }
}
