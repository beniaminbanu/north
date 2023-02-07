<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RequestServiceFormRequest
 * @package App\Http\Requests
 */
class RequestServiceFormRequest extends FormRequest
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
            'request_service_name'  => 'required|max:255',
            'request_service_email' => 'required|email|max:255',
            'request_service_phone' => 'required|max:255',
            'request_service_type'  => 'required',
            'g-recaptcha-response'    => 'required'
        ];
    }
}
