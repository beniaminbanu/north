<?php

namespace App\Http\ViewComposers;

use App\Models\Article;
use App\Models\Page;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Testimonial;
use Illuminate\View\View;

/**
 * Class PagesComposer
 *
 * @package App\Http\ViewComposers
 */
class PagesComposer
{
    /**
     * @var Page[]
     */
    protected $menus;

    /**
     * @var Page[]
     */
    protected $quick_links;

    /**
     * @var Testimonial[]
     */
    protected $testimonials;

    /**
     * @var Service[]
     */
    protected $footer_services;

    /**
     * @var Service[]
     */
    protected $request_services;

    /**
     * @var Article[]
     */
    protected $sidebar_articles;

    /**
     * PagesComposer constructor.
     */
    public function __construct()
    {
        if (is_null($this->menus)) {
            $this->menus = Page::getMenuItems();
        }

        if (is_null($this->quick_links)) {
            $this->quick_links = Page::getQuickLinks();
        }

        if (is_null($this->testimonials)) {
            $this->testimonials = Testimonial::translated()
                ->withTranslation()
                ->active()
                ->orderBy('order', 'asc')
                ->get();
        }

        if (is_null($this->footer_services)) {
            $this->footer_services = ServiceCategory::translated()
                ->with(['page' => function ($q) {
                    $q->active()->translated()->withTranslation();
                }])
                ->withTranslation()
                ->active()
                ->isHome()
                ->orderBy('order', 'asc')
                ->get();
        }

        if (is_null($this->request_services)) {
            $this->request_services = ServiceCategory::translated()
                ->with(['page' => function ($q) {
                    $q->active()->translated()->withTranslation();
                }])
                ->withTranslation()
                ->active()
                ->isHome()
                ->orderBy('order', 'asc')
                ->get();
        }

        if (is_null($this->sidebar_articles)) {
            $this->sidebar_articles = Article::getSidebarArticles();
        }
    }

    /**
     * @param View $view
     *
     * @return View
     */
    public function compose(View $view)
    {
        return $view
            ->withMenus($this->menus)
            ->withQuickLinks($this->quick_links)
            ->withTestimonials($this->testimonials)
            ->withFooterServices($this->footer_services)
            ->withRequestServices($this->request_services)
            ->withSidebarArticles($this->sidebar_articles);
    }
}
