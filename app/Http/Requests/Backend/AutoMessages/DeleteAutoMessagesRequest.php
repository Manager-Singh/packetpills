<?php

namespace App\Http\Requests\Backend\AutoMessages;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DeleteEnterpriseConnectsRequest.
 */
class DeleteAutoMessagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-auto-message');
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
