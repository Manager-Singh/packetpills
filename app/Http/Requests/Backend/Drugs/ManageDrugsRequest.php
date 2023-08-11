<?php

namespace App\Http\Requests\Backend\Drugs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageBlogsRequest.
 */
class ManageDrugsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-drug');
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
