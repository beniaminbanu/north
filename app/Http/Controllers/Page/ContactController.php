<?php

namespace App\Http\Controllers\Page;

use App\Models\Newsletter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Modules\Mailer\Mailer;

use Illuminate\Support\Facades\Log;

/**
 * Class ContactController
 * @package App\Http\Controllers\Page
 */
class ContactController extends Controller
{
    /**
     * @param ContactFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactFormRequest $request)
    {
        try {
            app()->make(Mailer::class)->send(
                'contact',
                array_merge($request->only([
                    'name',
                    'email',
                    'phone',
                    'body'
                ]), [
                    'newsletter' => $request->get('newsletter') ? 'Oui' : 'Non'
                ]),
                function ($m) {
                    $m->to(env('MAIL_TO_ADDRESS'));
                }
            );

            if ($request->get('newsletter')) {
                Newsletter::register($request->get('email'));
            }

            Log::debug('ContactController:store', [
                'request' => $request->all()
            ]);

            swal_success(trans('alerts.contact_message_succeeded'));

            return back();
        } catch (\Throwable $e) {
            swal_error(trans('alerts.contact_message_failed'));

            Log::error('ContactController:store', [
                'error'   => $e->getMessage(),
                'request' => $request->all()
            ]);

            return back()->withInput();
        }
    }
}
