<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing;

use App\Packages\Sluggable\Contracts\Routing\ControllerBag;
use App\Packages\Sluggable\Contracts\Routing\Handler as HandlerContract;
use App\Packages\Sluggable\Contracts\Routing\SlugCollection;
use App\Packages\Sluggable\Routing\Exceptions\HandlerExpectSpecificSlugException;

abstract class Handler implements HandlerContract
{
    /**
     * Expected slug-type pairs.
     *
     * @var array
     */
    protected $expectedSlugs = [];

    /**
     * Current slug collection.
     *
     * @var SlugCollection
     */
    protected $slugCollection;

    /**
     * Return a ControllerBag object if the given slug
     * collection match conditions, otherwise false.
     *
     * @param SlugCollection $slugCollection
     * @return ControllerBag|bool
     */
    public function handle(SlugCollection $slugCollection)
    {
        $this->slugCollection = $slugCollection;

        if (!$this->checkExpectedSlugs()) {
            return false;
        }

        return $this->makeControllerBag();
    }

    /**
     * Use the current slug collection to create and return
     * a ControllerBag object, or return false.
     *
     * @return ControllerBag|bool
     */
    abstract protected function makeControllerBag();

    /**
     * Check if current slug collection contains the expected slugs.
     */
    protected function checkExpectedSlugs()
    {
        foreach ($this->expectedSlugs as $accessor => $type) {
            if (!$this->slugCollection->hasSlug($accessor)) {
                return false;
            }

            if (!$this->slugCollection->getSlug($accessor) instanceof $type) {
                return false;
            }
        }

        return true;
    }
}