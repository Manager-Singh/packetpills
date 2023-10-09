<?php

namespace App\Http\Requests\Backend\MailMessages;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DeleteEnterpriseConnectsRequest.
 */
class DeleteMailMessagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-mail-message');
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
