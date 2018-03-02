<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueClientRecord;

class UpdateTargetList extends FormRequest
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
            'month_id' => ['required','numeric','between:1,12',
                new UniqueClientRecord('report_target_lists', 
                'target_year',
                NULL,
                NULL,
                $this->get('id'),'This month with this year already exists')
            ],
            'target_increase_potential_client' => 'required|numeric',
            'target_no_of_calls_made' => 'required|numeric',
            'target_proposal_tobe_sent' => 'required|numeric',
            'target_no_formal_presentation' => 'required|numeric',
            'target_client_tobe_acquired' => 'required|numeric',
            'target_year' => 'required|date_format:Y',
        ];
    }
}
