<?php

namespace App\Http\Controllers\Page;

use App\Models\Page;
use App\Models\Team;
use App\Models\Partner;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Http\Controllers\Controller;

/**
 * Class ServiceController
 * @package App\Http\Controllers\Page
 */
class ServiceController extends Controller
{
    /**
     * @param Page $page
     * @param string $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Page $page, Service $service)
    {

        $categories = ServiceCategory::translated()
            ->withTranslation()
            ->active()
            ->orderBy('order', 'asc')
            ->get();

        $services = Service::active()
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'asc')
            ->get();

        $partners = Partner::active()
            ->orderBy('order', 'asc')
            ->get();

        $teams = Team::active()
            ->translated()
            ->withTranslation()
            ->whereIsAboutUs(true)
            ->orderBy('order')
            ->get();

        return view('services.show', compact('page', 'categories', 'services', 'teams', 'partners'));
    }
}
