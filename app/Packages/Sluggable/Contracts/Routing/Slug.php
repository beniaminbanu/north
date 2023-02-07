<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Contracts\Routing;

interface Slug
{
    /**
     * Get the route accessor for slug.
     *
     * @return string
     */
    public function getAccessor();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the value of slug.
     *
     * @return string
     */
    public function getValue();
}