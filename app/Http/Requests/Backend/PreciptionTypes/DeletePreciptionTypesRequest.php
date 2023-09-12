<?php

namespace App\Http\Requests\Backend\PreciptionTypes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DeleteEnterpriseConnectsRequest.
 */
class DeletePreciptionTypesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-Preciption-types');
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
