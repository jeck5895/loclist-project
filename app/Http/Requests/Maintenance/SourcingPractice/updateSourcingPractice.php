<?php

namespace App\Http\Requests\Maintenance\SourcingPractice;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSourcingPractice extends FormRequest
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
            'name' => 'required|unique:sourcing_practices,name,'.$this->get('id')
        ];
    }
}
