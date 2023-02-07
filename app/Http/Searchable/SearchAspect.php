<?php

namespace App\Http\Searchable;

use Illuminate\Support\Collection;

/**
 * Class SearchAspect
 * @package App\Http\Searchable
 */
abstract class SearchAspect
{
    /**
     * @param string $term
     * @return Collection
     */
    abstract public function getResults(string $term): Collection;

    /**
     * @return string
     */
    abstract public function getType(): string;
}