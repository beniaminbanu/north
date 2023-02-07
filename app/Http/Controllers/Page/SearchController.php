<?php

namespace App\Http\Controllers\Page;

use App\Http\Searchable\Search;
use App\Http\Controllers\Controller;
use App\Http\Searchable\Aspects\PageAspect;
use App\Http\Searchable\Aspects\ArticleAspect;
use App\Http\Searchable\Aspects\ProjectAspect;
use App\Http\Searchable\Aspects\ServiceCategoryAspect;

use Illuminate\Http\Request;

/**
 * Class SearchController
 * @package App\Http\Controllers\Page
 */
class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $term = $request->get('q');

        if (empty($term)) {
            return response()->json([]);
        }

        return response()->json($this->getSearchables()->search($term)->groupByType());
    }

    /**
     * @return Search
     */
    private function getSearchables(): Search
    {
        return Search::new()
            ->registerAspect(PageAspect::class)
            ->registerAspect(ArticleAspect::class)
            ->registerAspect(ProjectAspect::class)
            ->registerAspect(ServiceCategoryAspect::class);
    }
}
