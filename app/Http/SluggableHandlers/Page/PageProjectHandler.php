<?php

namespace App\Http\SluggableHandlers\Page;

use App\Models\Page;
use App\Project;
use App\ServiceCategory;
use App\Packages\Sluggable\Routing\Query;
use App\Packages\Sluggable\Routing\Handler;
use App\Http\Controllers\Page\ProjectsController;
use App\Packages\Sluggable\Routing\ControllerBag;

/**
 * Class ServicePageHandler
 * @package App\Http\SluggableHandlers\Page
 */
class PageProjectHandler extends Handler
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

        if (null === $project = $this->findProjectBySlug($slugs)) {
            return false;
        }

        return new ControllerBag(
            ProjectsController::class,
            'show',
            [$page, $project]
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

        return Page::listedBySlug($slug->getValue())->whereHandlerController('ProjectsController')->first();
    }

    /**
     * @param Query $slugs
     * @return ServiceCategory|null
     */
    protected function findProjectBySlug(Query $slugs)
    {
        if (null === $slug = $slugs->offsetGet(1)) {
            return null;
        }

        return Project::listedBySlug($slug->getValue())->first();
    }
}
