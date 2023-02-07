<?php

namespace App\Http\SluggableHandlers\Page;

use App\Http\Controllers\Page\ArticlesController;
use App\Models\Page;
use App\Models\Article;
use App\Packages\Sluggable\Routing\Query;
use App\Packages\Sluggable\Routing\Handler;
use App\Packages\Sluggable\Routing\ControllerBag;

/**
 * Class ServicePageHandler
 * @package App\Http\SluggableHandlers\Page
 */
class PageArticleHandler extends Handler
{
    /**
     * Expected slug-type pairs.
     *
     * @var array
     */
    protected $expectedSlugs = [
        'slug' => Query::class,
    ];

    /**
     * Use the current slug collection to create and return
     * a ControllerBag object, or return false.
     *
     * @return \App\Packages\Sluggable\Contracts\Routing\ControllerBag|bool
     */
    protected function makeControllerBag()
    {
        $slugs = $this->slugCollection->getSlug('slug');

        if (null === $page = $this->findPageBySlug($slugs)) {
            return false;
        }

        if (null === $article = $this->findArticleBySlug($slugs)) {
            return false;
        }

        return new ControllerBag(
            ArticlesController::class,
            'show',
            [$page, $article]
        );
    }

    /**
     * @param Query $slugs
     * @return Page|null
     */
    protected function findPageBySlug(Query $slugs)
    {
        if (null === $slug = $slugs->offsetGet(0)) {
            return null;
        }

        return Page::listedBySlug($slug->getValue())->whereHandlerController('ArticlesController')->first();
    }

    /**
     * @param Query $slugs
     * @return Article|null
     */
    protected function findArticleBySlug(Query $slugs)
    {
        if (null === $slug = $slugs->offsetGet(1)) {
            return null;
        }

        return Article::listedBySlug($slug->getValue())->first();
    }
}
