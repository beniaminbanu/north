<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Helper;

use Illuminate\Support\Str;

class Slug
{
    /**
     * Generate a URL friendly slug from a given string.
     *
     * @param string $value
     * @return string
     */
    public static function slug($value)
    {
        return Str::slug($value, '-');
    }

    /**
     * Get the value of a URL slug.
     *
     * @param $slug
     * @return string
     */
    public static function value($slug)
    {
        return Str::slug($slug, ' ');
    }
}