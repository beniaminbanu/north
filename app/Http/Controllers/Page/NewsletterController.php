<?php

namespace App\Http\Controllers\Page;

use App\Models\Newsletter;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterFormRequest;

use Illuminate\Support\Facades\Log;

/**
 * Class NewsletterController
 * @package App\Http\Controllers\Page
 */
class NewsletterController extends Controller
{
    /**
     * Send contact message.
     *
     * @param NewsletterFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsletterFormRequest $request)
    {
        try {

            Newsletter::register(
                $request->get('newsletter_email')
            );

            Log::debug('NewsletterController:store', [
                'request' => $request->all()
            ]);

            swal_success(trans('alerts.newsletter_succeeded'));

            return back();
        } catch (\Throwable $e) {

            swal_error(trans('alerts.newsletter_failed'));

            Log::error('NewsletterController:store', [
                'error'   => $e->getMessage(),
                'request' => $request->all()
            ]);

            return back()->withInput();
        }
    }
}
