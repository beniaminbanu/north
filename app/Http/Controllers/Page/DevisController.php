<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\DevisFormRequest;
use App\Modules\Mailer\Mailer;

use Illuminate\Support\Facades\Log;

/**
 * Class DevisController
 *
 * @package App\Http\Controllers\Page
 */
class DevisController extends Controller
{
    /**
     * @param DevisFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DevisFormRequest $request)
    {
        try {

            app()->make(Mailer::class)->send(
                'devis',
                $request->only(['name', 'email', 'phone', 'body']),
                function ($m) {
                    $m->to(config('mail.from.address'));
                }
            );

            app()->make(Mailer::class)->send(
                'auto_reply',
                ['name' => $request->get('name')],
                function ($m) use ($request) {
                    $m->to($request->get('email'));
                }
            );

            Log::debug('DevisController:store', [
                'request' => $request->all()
            ]);
        } catch (\Throwable $e) {

            swal_error(trans('alerts.devis_message_failed'));

            Log::error('DevisController:store', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return back()->withInput();
        }

        swal_success(trans('alerts.devis_message_succeeded'));

        return back();
    }
}
