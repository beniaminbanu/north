<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ContactFormRequest
 *
 * @package App\Http\Requests
 */
class ContactFormRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'body' => 'required',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages() 
    {
        return [
            'name.required' => 'Numele este obligaroriu',
            'name.max' => 'Numele este prea lung',
            'email.required' => 'E-mailul este obligatoriu',
            'email.email' => 'E-mailul este invalid',
            'email.max' => 'E-mailul este prea lung',
            'body.required' => 'Mesajul este obligatoriu',
        ];
    }
}
