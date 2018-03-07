<?php

namespace App\Http\Requests\Maintainance\ActionPlan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActionPlan extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->userType ==1 ? true : false ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'action_name' => 'required|unique:action_plans,action_name,'.$this->get('id')
        ];
    }
}
