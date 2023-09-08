<?php

namespace App\Http\Requests\Backend\Prescriptions;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditPrescriptionsRequest.
 */
class EditPrescriptionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-prescription');
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
