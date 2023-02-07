<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DevisFormRequest
 * @package App\Http\Requests
 */
class DevisFormRequest extends FormRequest
{
    /**
     * ContactFormRequest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->redirect = '/#devis';
    }

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
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'body'  => 'required',
            'g-recaptcha-response'    => 'required'
        ];
    }

    /**
     * @param array $errors
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        swal_error(trans('alerts.check_if_the_provided_form_data_are_valid'));

        return parent::response($errors);
    }
}
