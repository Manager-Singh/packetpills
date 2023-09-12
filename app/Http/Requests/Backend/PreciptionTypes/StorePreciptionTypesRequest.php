<?php

namespace App\Http\Requests\Backend\PreciptionTypes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StorePrescriptionsRequest.
 */
class StorePreciptionTypesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-preciption-types');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'preciption_type' => 'required|max:191|unique:preciption_types,preciption_type',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Email template title must required',
            'title.max' => 'Email template title may not be greater than 191 characters.',
            'title.unique' => __('exceptions.backend.prescriptions.already_exists'),
        ];
    }
}
