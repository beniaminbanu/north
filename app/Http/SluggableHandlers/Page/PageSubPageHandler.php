<?php

namespace App\Http\SluggableHandlers\Page;

use App\Models\Page;
use App\Packages\Sluggable\Routing\Query;

/**
 * Class PageSubPageCategoryHandler
 * @package App\Http\SluggableHandlers\Page
 */
class PageSubPageHandler extends PageHandler
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

        if (null === $parent = $this->findPageBySlug($slugs)) {
            return false;
        }

        if (null === $page = $this->findSubPageBySlug($slugs)) {
            return false;
        }

        if (!$page->parent->is($parent)) {
            return false;
        }

        return $this->compile($page);
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

        return Page::listedBySlug($slug->getValue())->first();
    }

    /**
     * @param Query $slugs
     * @return Page|null
     */
    protected function findSubPageBySlug(Query $slugs)
    {
        if (null === $slug = $slugs->offsetGet(1)) {
            return null;
        }

        return Page::with('parent')->listedBySlug($slug->getValue())->first();
    }
}
