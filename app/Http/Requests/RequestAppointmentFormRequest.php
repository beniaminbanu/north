<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RequestAppointmentFormRequest
 * @package App\Http\Requests
 */
class RequestAppointmentFormRequest extends FormRequest
{
    /**
     * RequestAppointmentFormRequest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->redirect = '/#appointment';
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
            'request_appointment_first_name' => 'required|max:255',
            'request_appointment_last_name'  => 'required|max:255',
            'request_appointment_email'      => 'required|email|max:255',
            'request_appointment_phone'      => 'required|max:255',
            'request_appointment_details'    => 'required',
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
