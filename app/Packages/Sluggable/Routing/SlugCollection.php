<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing;

use App\Packages\Sluggable\Contracts\Routing\SlugCollection as SlugCollectionContract;
use App\Packages\Sluggable\Contracts\Routing\Slug as SlugContract;
use App\Packages\Sluggable\Contracts\Routing\Query as QueryContract;
use App\Packages\Sluggable\Routing\Exceptions\SlugCollectionExpectsArrayOfSlugsException;
use App\Packages\Sluggable\Routing\Exceptions\SlugNameExistsInSlugCollectionException;
use ArrayAccess;
use Iterator;

class SlugCollection implements SlugCollectionContract, ArrayAccess, Iterator
{
    /**
     * Array of slugs objects.
     *
     * @var array
     */
    protected $slugs = [];

    /**
     * Create a new SlugCollection.
     *
     * @param array $slugs
     */
    public function __construct(array $slugs)
    {
        foreach ($slugs as $slug) {
            $this->attach($slug);
        }
    }

    /**
     * Add a new slug to collection.
     *
     * @param $slug
     */
    protected function attach($slug)
    {
        $this->checkSlug($slug);

        $this->slugs[$slug->getAccessor()] = $slug;
    }

    /**
     * Throw specific exceptions if the slug is not valid.
     *
     * @param $slug
     * @throws SlugCollectionExpectsArrayOfSlugsException
     * @throws SlugNameExistsInSlugCollectionException
     */
    protected function checkSlug($slug)
    {
        if (!$slug instanceof SlugContract && !$slug instanceof QueryContract) {
            throw (new SlugCollectionExpectsArrayOfSlugsException)->setAcceptedSlugs([
                SlugContract::class,
                QueryContract::class
            ]);
        }

        if (array_key_exists($slug->getAccessor(), $this->slugs)) {
            throw (new SlugNameExistsInSlugCollectionException)->setDuplicateName($slug->getAccessor());
        }
    }

    /**
     * Checks if slug exists in collection.
     *
     * @param string $accessor
     * @return bool
     */
    public function hasSlug($accessor)
    {
        return array_key_exists($accessor, $this->slugs);
    }

    /**
     * Get a slug by name.
     *
     * @param string $accessor
     * @return mixed|null
     */
    public function getSlug($accessor)
    {
        if ($this->hasSlug($accessor)) {
            return $this->slugs[$accessor];
        }

        return null;
    }

    /**
     * Returns an array of slugs.
     *
     * @return array
     */
    public function getAllSlugs()
    {
        return $this->slugs;
    }

    /**
     * Determine if a given offset exists.
     *
     * @param mixed $slugName
     * @return bool
     */
    public function offsetExists($slugName)
    {
        return $this->hasSlug($slugName);
    }

    /**
     * Get the value at a given offset.
     *
     * @param mixed $slugName
     * @return mixed
     */
    public function offsetGet($slugName)
    {
        return $this->getSlug($slugName);
    }

    /**
     * Do nothing.
     *
     * @param string $key
     * @param mixed $value
     */
    public function offsetSet($key, $value) {}

    /**
     * Do nothing.
     *
     * @param mixed $key
     */
    public function offsetUnset($key) {}

    /**
     * Return the current slug.
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->slugs);
    }

    /**
     * Move forward to next slug.
     *
     * @return void
     */
    public function next()
    {
        return next($this->slugs);
    }

    /**
     * Return the name of the current slug.
     *
     * @return string
     */
    public function key()
    {
        return key($this->slugs);
    }

    /**
     * Checks if current position is valid.
     *
     * @return bool
     */
    public function valid()
    {
        return key($this->slugs) !== null;
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @return void
     */
    public function rewind()
    {
        return reset($this->slugs);
    }
}