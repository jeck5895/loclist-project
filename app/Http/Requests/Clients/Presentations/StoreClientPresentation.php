<?php

namespace App\Http\Requests\Clients\Presentations;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientPresentation extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'client_id' => 'required',
            'company_id' => 'required',
            'presentation_mode' => 'required',
            'presentor' => 'required',
            'date_presented' => 'required|unique:client_presentations',
            'client_response2' => 'required',
            'presentation_status' => 'required',
            'action_plan' => 'required',
        ];
    }
}
