<?php

namespace App\Http\Searchable;

/**
 * Interface Searchable
 * @package App\Http\Searchable
 */
interface Searchable
{
    /**
     * @return SearchResult
     */
    public function getSearchResult(): SearchResult;
}