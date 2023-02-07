<?php

namespace App\Http\Controllers\Page;

use App\Models\Page;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Http\Controllers\Controller;

/**
 * Class ArticlesController
 * @package App\Http\Controllers\Page
 */
class ArticlesController extends Controller
{
    /**
     * @param Page $page
     * @param $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Page $page, $view)
    {
        $articles = Article::translated()
            ->with('categories.translation')
            ->withTranslation()
            ->active()
            ->orderBy('order', 'asc')
            ->get();

        $category = ArticleCategory::translated()
            ->withTranslation()
            ->active()
            ->orderBy('order', 'asc')
            ->get();

        return view($view, compact('page', 'articles', 'category'));
    }

    /**
     * @param Page $page
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Page $page, Article $article)
    {
        $articles = Article::translated()
            ->with('categories.translation')
            ->withTranslation()
            ->active()
            ->orderBy('order', 'asc')
            ->get();

        return view('pages.article', compact('page', 'article', 'articles'));
    }
}
