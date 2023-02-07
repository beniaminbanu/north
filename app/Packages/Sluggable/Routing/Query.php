<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing;

use Iterator;
use ArrayAccess;
use App\Packages\Sluggable\Contracts\Routing\Query as QueryContract;

class Query extends AbstractSlug implements QueryContract, ArrayAccess, Iterator
{
    /**
     * Query slugs.
     *
     * @var array
     */
    protected $slugs = [];

    /**
     * Current position in iterator.
     *
     * @var int
     */
    protected $position = 0;

    /**
     * Create a new query slug.
     *
     * @param string $accessor
     * @param string $query
     */
    public function __construct($accessor, $query)
    {
        parent::__construct($accessor);

        foreach (explode('/', $query) as $position => $slug) {
            $this->slugs[] = new Slug($this->getAccessor().'_'.$position, $slug);
        }
    }

    /**
     * Get the list of slugs from query.
     *
     * @return string
     */
    public function getSlugs()
    {
        return $this->slugs;
    }

    /**
     * Determine if a given offset exists.
     *
     * @param number $position
     * @return bool
     */
    public function offsetExists($position)
    {
        return isset($this->slugs[$position]);
    }

    /**
     * Get the value at a given offset.
     *
     * @param number $position
     * @return mixed
     */
    public function offsetGet($position)
    {
        return isset($this->slugs[$position]) ? $this->slugs[$position] : null;
    }

    /**
     * Do nothing.
     *
     * @param string $position
     * @param mixed $value
     */
    public function offsetSet($position, $value) {}

    /**
     * Do nothing.
     *
     * @param mixed $position
     */
    public function offsetUnset($position) {}

    /**
     * Return the current slug from query.
     *
     * @return mixed
     */
    public function current()
    {
        return $this->slugs[$this->position];
    }

    /**
     * Move to next slug from query.
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Return the key of the current slug from query.
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Check if current position is valid.
     */
    public function valid()
    {
        return isset($this->slugs[$this->position]);
    }

    /**
     * Rewind the Iterator to the first element.
     */
    public function rewind()
    {
        $this->position = 0;
    }
}