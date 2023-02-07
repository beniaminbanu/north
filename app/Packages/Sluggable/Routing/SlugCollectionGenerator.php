<?php

/**
 *
 * @author dragosandreidinu
 *
 */

namespace App\Packages\Sluggable\Routing;

use App\Packages\Sluggable\Contracts\Routing\SlugCollection as SlugCollectionContract;
use App\Packages\Sluggable\Contracts\Routing\SlugCollectionGenerator as SlugCollectionGeneratorContract;
use App\Packages\Sluggable\Routing\Exceptions\SlugCollectionGeneratorExpectsArrayOfStringsException;
use Illuminate\Support\Arr;

class SlugCollectionGenerator implements SlugCollectionGeneratorContract
{
    /**
     * Create a collection of slugs.
     *
     * @param mixed $slugs
     * @return SlugCollectionContract
     */
    public function generate($slugs)
    {
        if (!$this->checkSlugs($slugs)) {
            throw new SlugCollectionGeneratorExpectsArrayOfStringsException;
        }

        return new SlugCollection(
            $this->build($slugs)
        );
    }

    /**
     * Checks if the parameter is array and if it contains only strings.
     *
     * @param mixed $slugs
     * @return bool
     */
    protected function checkSlugs($slugs)
    {
        if (!is_array($slugs)) {
            return false;
        }

        $onlyString = Arr::where($slugs, function ($value) {
            return is_string($value);
        });

        return count($slugs) == count($onlyString);
    }

    /**
     * Create an array of slug objects.
     *
     * @param array $slugs
     * @return array
     */
    protected function build(array $slugs)
    {
        $slugsObjects = [];

        foreach ($slugs as $accessor => $slug) {
            if (count(explode('/', $slug)) > 1) {
                $slugsObjects[] = new Query($accessor, $slug);

                continue;
            }

            $slugsObjects[] = new Slug($accessor, $slug);
        }

        return $slugsObjects;
    }
}
