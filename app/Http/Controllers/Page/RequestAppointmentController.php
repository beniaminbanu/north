<?php

namespace App\Http\Controllers\Page;


use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAppointmentFormRequest;
use App\Modules\Mailer\Mailer;

use Illuminate\Support\Facades\Log;

/**
 * Class RequestAppointmentController
 * @package App\Http\Controllers\Page
 */
class RequestAppointmentController extends Controller
{
    /**
     * @param RequestAppointmentFormRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(RequestAppointmentFormRequest $request)
    {
        try {

            app()->make(Mailer::class)->send(
                'request_appointment',
                [
                    'first_name' => $request->get('request_appointment_first_name'),
                    'last_name'  => $request->get('request_appointment_last_name'),
                    'email'      => $request->get('request_appointment_email'),
                    'phone'      => $request->get('request_appointment_phone'),
                    'details'    => $request->get('request_appointment_details')
                ],
                function ($m) {
                    $m->to(config('mail.from.address'));
                }
            );

            app()->make(Mailer::class)->send(
                'auto_reply',
                [
                    'name' => implode(' ', $request->only([
                        'request_appointment_first_name',
                        'request_appointment_last_name'
                    ]))
                ],
                function ($m) use ($request) {
                    $m->to($request->get('request_appointment_email'));
                }
            );

            Log::debug('RequestAppointmentController:store', [
                'request' => $request->all()
            ]);

            swal_success(trans('alerts.request_appointment_message_succeeded'));

            return back();
        } catch (\Throwable $e) {

            swal_error(trans('alerts.request_appointment_message_failed'));

            Log::error('RequestAppointmentController:store', [
                'error'   => $e->getMessage(),
                'request' => $request->all()
            ]);

            return back()->withInput();
        }
    }
}
