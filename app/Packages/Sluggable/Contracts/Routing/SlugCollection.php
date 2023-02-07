<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Contracts\Routing;

interface SlugCollection
{
    /**
     * Checks if slug exists in collection.
     *
     * @param string $accessor
     * @return bool
     */
    public function hasSlug($accessor);

    /**
     * Get a slug by name.
     *
     * @param string $accessor
     * @return mixed
     */
    public function getSlug($accessor);

    /**
     * Returns an array of slugs.
     *
     * @return array
     */
    public function getAllSlugs();
}