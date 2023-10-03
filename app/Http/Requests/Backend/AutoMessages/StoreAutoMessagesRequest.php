<?php

namespace App\Http\Requests\Backend\AutoMessages;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StorePrescriptionsRequest.
 */
class StoreAutoMessagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-auto-messages');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => 'required|max:191|unique:auto_messages,message',
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
            // 'title.required' => 'Email template title must required',
            // 'title.max' => 'Email template title may not be greater than 191 characters.',
            // 'title.unique' => __('exceptions.backend.prescriptions.already_exists'),
        ];
    }
}
