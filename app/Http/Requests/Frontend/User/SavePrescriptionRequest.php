<?php

namespace App\Http\Requests\Frontend\User;

use App\Helpers\Auth\SocialiteHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class SavePrescriptionRequest.
 */
class SavePrescriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'prescription_upload' => ['sometimes', 'image'],
        ];
    }
}
