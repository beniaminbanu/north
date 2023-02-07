<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing\Exceptions;

use InvalidArgumentException;

class SlugCollectionExpectsArrayOfSlugsException extends InvalidArgumentException
{
    /**
     * Accepted classes of slugs.
     *
     * @var array
     */
    protected $slugs = [];

    /**
     * Set accepted classes of slugs.
     *
     * @param array $slugs
     * @return $this
     */
    public function setAcceptedSlugs(array $slugs)
    {
        $this->slugs = $slugs;

        $classes = implode(', ', $slugs);

        $this->message = "SlugCollection expects an array of slugs ({$classes})";

        return $this;
    }

    /**
     * Get accepted classes of slugs.
     *
     * @return array
     */
    public function getAcceptedSlugs()
    {
        return $this->slugs;
    }
}