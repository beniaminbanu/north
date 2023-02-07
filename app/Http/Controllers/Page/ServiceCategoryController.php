<?php

namespace App\Http\Controllers\Page;

use App\Models\Page;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;

/**
 * Class ServiceCategoryController
 * @package App\Http\Controllers\Page
 */
class ServiceCategoryController extends Controller
{
    /**
     * @param Page $page
     * @param ServiceCategory $serviceCategory
     * @return $this
     */
    public function show(Page $page, ServiceCategory $serviceCategory)
    {
        $services = $serviceCategory
            ->services()
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        return view('services.show', compact('page', 'serviceCategory', 'services'));
    }
}
