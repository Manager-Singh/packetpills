<?php

namespace App\Http\Requests\Backend\Drugs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreDrugsRequest.
 */
class StoreDrugsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-drug');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand_name' => ['required', 'string'],
            'generic_name' => ['required', 'string'],
            'main_therapeutic_use' => ['required', 'string'],
            'strength' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'strength_unit_id' => ['required'],
            'format_id' => ['required'],
            'pack_size' => ['required'],
            'pack_unit_id' => ['required'],
            'din' => ['required'],
            'upc' => ['required'],
            'pharmacy_purchase_price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'percent_markup' => ['required'],
            'dispensing_fee' => ['required'],
            'insurance_coverage_in_percent' => ['required'],
            'status' => ['required'],
        ];
    }
    
    /**
     * Get the validation message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'strength_unit_id.required' => 'Please select strength unit of drug',
            'format_id.required' => 'Please select format of drug',
            'pack_unit_id.required' => 'Please select pack unit of drug',
            'insurance_coverage_in_percent.required' => 'Please select insurance coverage in percent of drug',
            
           
        ];
    }
}
