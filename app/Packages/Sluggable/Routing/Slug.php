<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing;

use App\Packages\Sluggable\Contracts\Routing\Slug as SlugContract;
use App\Packages\Sluggable\Helper\Slug as SlugHelper;

class Slug extends AbstractSlug implements SlugContract
{
    /**
     * The slug.
     *
     * @var
     */
    protected $slug;

    /**
     * The value of slug.
     *
     * @var string
     */
    protected $value;

    /**
     * Create a new Slug object.
     *
     * @param string $accessor
     * @param string $slug
     */
    public function __construct($accessor, $slug)
    {
        parent::__construct($accessor);

        $this->slug = SlugHelper::slug($slug);
        $this->value = SlugHelper::value($slug);
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the value of slug.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}