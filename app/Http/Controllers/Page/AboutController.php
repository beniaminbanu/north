<?php

namespace App\Http\Controllers\Page;

use App\Models\Page;
use App\Models\Provider;
use App\Http\Controllers\Controller;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class AboutController extends Controller
{
    /**
     * Display the page content.
     *
     * @param Page $page
     * @param string $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Page $page, $view)
    {
        $provider = Provider::active()
            ->orderBy('order', 'asc')
            ->get();

        return view($view)->with(compact('page', 'provider'));
    }
}
