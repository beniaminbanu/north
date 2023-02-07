<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestServiceFormRequest;
use App\Modules\Mailer\Mailer;
use Illuminate\Support\Facades\Log;

/**
 * Class RequestServiceController
 * @package App\Http\Controllers\Page
 */
class RequestServiceController extends Controller
{
    /**
     * @param RequestServiceFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RequestServiceFormRequest $request)
    {
        try {

            app()->make(Mailer::class)->send(
                'request_service',
                [
                    'name'    => $request->get('request_service_name'),
                    'email'   => $request->get('request_service_email'),
                    'phone'   => $request->get('request_service_phone'),
                    'service' => $request->get('request_service_type'),
                    'details' => $request->get('request_service_details')
                ],
                function ($m) {
                    $m->to(config('mail.from.address'));
                }
            );

            app()->make(Mailer::class)->send(
                'auto_reply',
                [
                    'name' => $request->get('request_service_name')
                ],
                function ($m) use ($request) {
                    $m->to($request->get('request_service_email'));
                }
            );

            Log::debug('RequestServiceController:store', [
                'request' => $request->all()
            ]);

            swal_success(trans('alerts.request_service_message_succeeded'));

            return back();
        } catch (\Throwable $e) {

            swal_error(trans('alerts.request_service_message_failed'));

            Log::error('RequestServiceController:store', [
                'error'   => $e->getMessage(),
                'request' => $request->all()
            ]);

            return back()->withInput();
        }
    }
}
