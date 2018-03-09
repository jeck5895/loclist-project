<?php

namespace App\Http\Requests\Maintenance\UserType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserType extends FormRequest
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
            'userType' => 'required|unique:user_types,userType,'.$this->get('id'),
            'add_clients' => 'boolean',
            'edit_clients' => 'boolean',
            'delete_clients' => 'boolean',
            'add_client_calls' => 'boolean',
            'edit_client_calls' => 'boolean',
            'delete_client_calls' =>  'boolean',
            'add_client_saturations' => 'boolean',
            'edit_client_saturations' => 'boolean',
            'delete_client_saturations' => 'boolean',
            'add_client_presentations' => 'boolean',
            'edit_client_presentations' => 'boolean',
            'delete_client_presentations' => 'boolean',
            'add_client_acquisitions' => 'boolean',
            'edit_client_acquisitions' => 'boolean',
            'delete_client_acquisitions' => 'boolean',
            'add_user' => 'boolean',
            'edit_user' => 'boolean',
            'delete_user' => 'boolean'
        ];
    }
}
