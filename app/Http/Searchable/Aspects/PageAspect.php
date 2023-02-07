<?php

namespace App\Http\Searchable\Aspects;

use App\Page;
use Illuminate\Support\Collection;
use App\Http\Searchable\SearchAspect;

/**
 * Class PageAspect
 * @package App\Http\Searchable\Aspects
 */
class PageAspect extends SearchAspect
{
    /**
     * @param string $term
     * @return Collection
     */
    public function getResults(string $term): Collection
    {
        return Page::active()
            ->translated()
            ->withTranslation()
            ->whereTranslation('name', 'LIKE', '%' . $term . '%')
            ->whereIsSearchable(true)
            ->get();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return trans('search.pages');
    }
}