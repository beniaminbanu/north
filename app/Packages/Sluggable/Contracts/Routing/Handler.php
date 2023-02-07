<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Contracts\Routing;

interface Handler
{
    /**
     * Return a ControllerBag object if the given slug
     * collection match conditions, otherwise false.
     *
     * @param SlugCollection $slugCollection
     * @return ControllerBag|bool
     */
    public function handle(SlugCollection $slugCollection);
}