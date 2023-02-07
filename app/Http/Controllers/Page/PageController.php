<?php

namespace App\Http\Controllers\Page;

use App\Models\Page;
use App\Http\Controllers\Controller;

/**
 * Class PageController
 *
 * @package App\Http\Controllers\Page
 */
class PageController extends Controller
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
        $url = str_replace('/', '', str_replace('/ro', '', str_replace('/en', '', $_SERVER['REQUEST_URI'])));
        if ($url == 'presentation' || $url == 'prezentare' || $url == 'ne-perdez-plus-de-temps') {
            return view('errors.404');
        }

        return view($view, compact('page'));
    }
}
