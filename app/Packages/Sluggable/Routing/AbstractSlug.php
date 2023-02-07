<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing;

abstract class AbstractSlug
{
    /**
     * The route accessor for slug.
     *
     * @var string
     */
    protected $accessor;

    /**
     * Create a new object.
     *
     * @param string $accessor
     */
    public function __construct($accessor)
    {
        $this->accessor = $accessor;
    }

    /**
     * Get the route accessor for slug.
     *
     * @return string
     */
    public function getAccessor()
    {
        return $this->accessor;
    }
}