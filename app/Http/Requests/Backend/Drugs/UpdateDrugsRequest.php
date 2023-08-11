<?php

namespace App\Http\Requests\Backend\Drugs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateBlogsRequest.
 */
class UpdateDrugsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-drug');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:191', 'unique:drugs,name,'.optional($this->route('drug'))->id],
           // 'available_form' => ['required', 'string'],
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
            'name.unique' => 'Drug name already exists, please enter a different name.',
            'name.required' => 'Please insert Drug Title',
            'name.max' => 'Drug Title may not be greater than 191 characters.',
        ];
    }
}
