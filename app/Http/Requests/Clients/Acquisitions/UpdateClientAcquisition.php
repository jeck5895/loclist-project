<?php

namespace App\Http\Requests\Clients\Acquisitions;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueClientRecord;

class UpdateClientAcquisition extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->userRole->edit_client_acquisitions == 1 ? true : false;
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
            'status_as_of' => ['required', 
                new UniqueClientRecord('client_acquisitions', 
                'client_id' , 
                'company_id', 
                'acquired_by',
                $this->get('id') 
            )],
            'status' => 'required',
            'date_acquired' => [ 
                new UniqueClientRecord('client_acquisitions', 
                'client_id' , 
                'company_id', 
                'acquired_by',
                $this->get('id') 
            )],
            'acquired_by' => 'required',
            'signed_contract' => 'required',
            'manner_of_acquisition' => 'required',
            'name_of_related_client' => 'required',
            'initial_hc_acquired' => 'required',
            'remarks' => 'required',
        ];
    }
}
