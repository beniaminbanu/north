<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NewsletterFormRequest
 * @package App\Http\Requests
 */
class NewsletterFormRequest extends FormRequest
{
    /**
     * ContactFormRequest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->redirect = '/#newsletter';
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
            'newsletter_email' => 'required|email'
        ];
    }
}
