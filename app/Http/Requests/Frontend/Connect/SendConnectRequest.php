<?php

namespace App\Http\Requests\Frontend\Connect;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Http\Exceptions\HttpResponseException;

// use Illuminate\Contracts\Validation\Validator;

/**
 * Class SendContactRequest.
 */
class SendConnectRequest extends FormRequest
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
        //die('kkk');
        return [
            'full_name' => ['required'],
            'company' => ['required'],
            'job_title' => ['required'],
            'email' => ['required', 'email'],
            'phone_no' => ['required'],
            'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
        ];
    }

    // public function failedValidation(Validator $validator)

    // {

    //     throw new HttpResponseException(response()->json([

    //         'success'   => false,

    //         'message'   => 'Validation errors',

    //         'data'      => $validator->errors()

    //     ]));

    // }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ];
    }
}
