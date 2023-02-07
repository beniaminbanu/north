<?php

namespace App\Http\Controllers\Page;

use App\Models\Page;
use App\Models\Team;
use App\Models\Service;
use App\Models\Partner;
use App\Http\Controllers\Controller;

/**
 * Class ServicesController
 * @package App\Http\Controllers\Page
 */
class ServicesController extends Controller
{
    /**
     * @param Page $page
     * @param string $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Page $page, string $view)
    {
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

        return view('pages.services', compact('page', 'services', 'teams', 'partners'));
    }

    /**
     * @param Page $page
     * @param ServiceCategory $serviceCategory
     * @return $this
     */
    public function show(Page $page, Service $service)
    {

        $childrens = $service
            ->childrens()
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        if ($childrens->count()) {
            return view('services.index', [
                'page' => $service,
                'services' => $childrens
            ]);
        }

        $prev = Service::active()
            ->doesntHave('childrens')
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'desc')
            ->where('id', '<', $service->id)
            ->limit(1)
            ->first();

        $next = Service::active()
            ->doesntHave('childrens')
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'asc')
            ->where('id', '>', $service->id)
            ->limit(1)
            ->first();

        $ids = [$service->id];

        if ($prev) {
            array_push($ids, $prev->id);
        }

        if ($next) {
            array_push($ids, $next->id);
        }

        $teams = Team::active()
            ->translated()
            ->withTranslation()
            ->whereIsAboutUs(true)
            ->orderBy('order')
            ->get();

        $services = Service::active()
            ->whereParentId(0)
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'asc')
            ->get();

        return view('services.show', compact('page', 'service', 'services', 'next', 'prev', 'teams'));
    }
}
