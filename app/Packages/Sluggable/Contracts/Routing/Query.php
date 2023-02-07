<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Contracts\Routing;

interface Query
{
    /**
     * Get the route accessor for query.
     *
     * @return string
     */
    public function getAccessor();

    /**
     * Get the list of slugs from query.
     *
     * @return string
     */
    public function getSlugs();
}