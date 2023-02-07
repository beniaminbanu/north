<?php

namespace App\Http\Controllers\Page;

use App\Models\Page;
use App\Models\Team;
use App\Http\Controllers\Controller;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class MissionEtVisionController extends Controller
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
        $teams = Team::active()
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        return view($view)->with(compact('page', 'teams'));
    }
}
