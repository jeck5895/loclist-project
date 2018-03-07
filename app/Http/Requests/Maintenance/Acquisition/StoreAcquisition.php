<?php

namespace App\Http\Requests\Maintainance\Acquisition;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcquisition extends FormRequest
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
            'acquisition_name' => 'required|unique:manner_of_acquisitions'
        ];
    }
}
