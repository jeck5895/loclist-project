<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->userRole->add_clients == 1 ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'entry_by' => 'required',
            // 'overall_status' => 'required',
            'client_name' => 'required|unique:clients',
            'industry' => 'required|numeric',
            'nationality' => 'required|numeric',
            'iso_certf' => 'required|numeric',
            'complete_mailing_address' => 'required',
            'techno_park' => 'required',
            'street_address' => 'required',
            'province' => 'required',
            'administrative_area_level_1' => 'required',
            'postal_code' => 'required|numeric',
            'company' => 'required',
            'website' => 'required',
            'primary_landline' => 'required',
            'other_landline' => 'required',
            // 'mobile_number' => 'required',
            // 'email_address' => 'required|email',
            // 'contact_person' => 'required',
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'gender' => 'required',
            // 'department' => 'required|numeric',
            // 'position' => 'required|numeric',
            'proposal' => 'required'
        ];
    }
}
