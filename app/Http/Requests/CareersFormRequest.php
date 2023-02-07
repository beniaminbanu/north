<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CareersFormRequest
 * @package App\Http\Requests
 */
class CareersFormRequest extends FormRequest
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
            'position' => 'required',
            'category' => 'required',
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'required|max:255',
            'g-recaptcha-response'    => 'required'
        ];
    }
}
