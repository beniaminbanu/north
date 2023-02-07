<?php

namespace App\Http\SluggableHandlers\Page;

use App\Models\Page;
use App\Models\ServiceCategory;
use App\Packages\Sluggable\Routing\Query;
use App\Packages\Sluggable\Routing\Handler;
use App\Packages\Sluggable\Routing\ControllerBag;
use App\Http\Controllers\Page\ServiceCategoryController;

/**
 * Class ServicePageHandler
 * @package App\Http\SluggableHandlers\Page
 */
class PageServiceCategoryHandler extends Handler
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

        if (null === $serviceCategory = $this->findServiceCategoryBySlug($slugs)) {
            return false;
        }

        if (!$serviceCategory->page->is($page)) {
            return false;
        }

        return new ControllerBag(
            ServiceCategoryController::class,
            'show',
            [$page, $serviceCategory]
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

        return Page::listedBySlug($slug->getValue())->first();
    }

    /**
     * @param Query $slugs
     * @return ServiceCategory|null
     */
    protected function findServiceCategoryBySlug(Query $slugs)
    {
        if (null === $slug = $slugs->offsetGet(1)) {
            return null;
        }

        return ServiceCategory::listedBySlug($slug->getValue())->first();
    }
}
