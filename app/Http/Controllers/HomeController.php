<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Page;
use App\Models\Provider;
use App\Models\Question;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Slide;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @param Page $page
     * @param string $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $homePage = Page::getWelcomePage();

        $slides = Slide::active()
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'asc')
            ->get();

        $services = Service::active()
            ->with([
                'categories' => function ($q) {
                    $q->active()
                        ->translated()
                        ->withTranslation()
                        ->with(['page' => function ($q) {
                            $q->active()
                                ->translated()
                                ->withTranslation();
                        }]);
                }
            ])
            ->translated()
            ->withTranslation()
            ->whereIsHome(true)
            ->orderBy('order', 'asc')
            ->get();

        $articles = Article::translated()
            ->with('categories.translation')
            ->withTranslation()
            ->active()
            ->orderBy('order', 'asc')
            ->limit(6)
            ->get();

        $questions = Question::active()
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        $serviceCategories = ServiceCategory::translated()
            ->with(['page' => function ($q) {
                $q->active()->translated()->withTranslation();
            }])
            ->withTranslation()
            ->active()
            ->isHome()
            ->orderBy('order_home', 'asc')
            ->limit(5)
            ->get();

        $articleCategories = ArticleCategory::translated()
            ->withTranslation()
            ->active()
            ->limit(7)
            ->get();

        $initialInfo = Page::where('handler_controller', 'InitialInfoController')
            ->translated()
            ->withTranslation()
            ->first();

        return view(
            'homepage',
            compact(
                'homePage',
                'articles',
                'slides',
                'services',
                'serviceCategories',
                'articleCategories',
                'questions',
            )
        );
    }
}
