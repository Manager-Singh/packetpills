<?php

namespace App\Http\Requests\Backend\AutoMessages;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManagePrescriptionsRequest.
 */
class ManageAutoMessagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-auto-messages');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
