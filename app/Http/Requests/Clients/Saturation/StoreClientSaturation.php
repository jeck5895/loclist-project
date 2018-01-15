<?php

namespace App\Http\Requests\clients\Saturation;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueClientRecord;

class StoreClientSaturation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !empty($this->user()) ? true : false;;
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
            'saturation_date' => ['required', 
                new UniqueClientRecord('client_saturations', 
                'client_id' , 
                'company_id', 
                'proposal_by' 
            )],
            'saturation_mode' => 'required',
            'proposal_by' => 'required',
            // 'call_slip' => 'required',
            'date_received' => 'required',
            'proposal_accepted' => 'required',
            'manner_of_confirmation' => 'required',
            'client_response1' => 'required',
            'ff_calls_made' => 'required',
            // 'last_ffup_date' => 'required',
        ];
    }
}
