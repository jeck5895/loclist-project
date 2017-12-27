<?php

namespace App\Http\Requests\clients\Calls;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientCall extends FormRequest
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
            'caller' => 'required',
            'date_of_call' => 'required',
            'confirmation_preCall' => 'required',
            'productive_call' => 'required',
            'proposal_sent' => 'required',
            'client_response' => 'required',
            'client_id' => 'required'
        ];
    }
}
