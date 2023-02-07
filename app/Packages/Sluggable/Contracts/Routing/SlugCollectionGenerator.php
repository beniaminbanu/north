<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Contracts\Routing;

interface SlugCollectionGenerator
{
    /**
     * Create a collection of slugs.
     *
     * @param mixed $slugs
     * @return SlugCollection
     */
    public function generate($slugs);
}