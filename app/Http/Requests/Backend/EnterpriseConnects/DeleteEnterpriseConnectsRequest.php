<?php

namespace App\Http\Requests\Backend\EnterpriseConnects;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DeleteEnterpriseConnectsRequest.
 */
class DeleteEnterpriseConnectsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-enterprise-connects');
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
