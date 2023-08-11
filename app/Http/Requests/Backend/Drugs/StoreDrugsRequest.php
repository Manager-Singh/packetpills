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
            'name' => ['required', 'max:191', 'unique:drugs,name'],
            //'available_form' => ['required', 'string'],
            'description' => ['required', 'string'],
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
            'name.required' => 'Please insert Drug Name',
            'name.max' => 'Drug Title may not be greater than 191 characters.',
            'name.unique' => 'The drug name already taken. Please try with different name.',
        ];
    }
}
