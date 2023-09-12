<?php

namespace App\Http\Requests\Backend\PreciptionTypes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePrescriptionsRequest.
 */
class UpdatePreciptionTypesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-Preciption-types');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'preciption_type' => 'required|max:191|unique:preciption_types,preciption_type,'.$this->segment(3),
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
            'title.unique' => __('exceptions.backend.email-templates.already_exists'),
            'title.required' => 'Email Template title must required',
            'title.max' => 'Email template title may not be greater than 191 characters.',
        ];
    }
}
