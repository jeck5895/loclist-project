<?php

namespace App\Http\Requests\Maintainance\Position;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePosition extends FormRequest
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
            'department_id' => 'required',
            'position_name' => 'required|unique:positions,position_name,'.$this->get('id')
        ];
    }

    public function messages() 
    {
        return [
            'department_id.required' => 'Department field is required',
            'position_name.required' => 'Position field is required',
            'position_name.unique' => 'Position already exists'
        ];
    }
}
