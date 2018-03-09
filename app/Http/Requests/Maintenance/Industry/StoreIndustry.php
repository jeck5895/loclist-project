<?php

namespace App\Http\Requests\Maintenance\Industry;

use Illuminate\Foundation\Http\FormRequest;

class StoreIndustry extends FormRequest
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
            'industry_name' => 'required|unique:industries'
        ];
    }
}
