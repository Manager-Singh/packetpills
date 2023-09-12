<?php

namespace App\Http\Requests\Backend\PreciptionTypes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManagePrescriptionsRequest.
 */
class ManagePreciptionTypesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-preciption-types');
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
