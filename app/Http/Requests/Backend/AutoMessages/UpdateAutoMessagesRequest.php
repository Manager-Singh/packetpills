<?php

namespace App\Http\Requests\Backend\AutoMessages;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePrescriptionsRequest.
 */
class UpdateAutoMessagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-auto-messages');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => 'required|max:191|unique:auto_messages,message,'.$this->segment(3),
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
            // 'title.unique' => __('exceptions.backend.email-templates.already_exists'),
            // 'title.required' => 'Email Template title must required',
            // 'title.max' => 'Email template title may not be greater than 191 characters.',
        ];
    }
}
