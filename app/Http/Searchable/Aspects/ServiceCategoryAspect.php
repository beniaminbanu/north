<?php

namespace App\Http\Searchable\Aspects;

use App\Project;
use App\ServiceCategory;
use Illuminate\Support\Collection;
use App\Http\Searchable\SearchAspect;

/**
 * Class ServiceCategoryAspect
 * @package App\Http\Searchable\Aspects
 */
class ServiceCategoryAspect extends SearchAspect
{
    /**
     * @param string $term
     * @return Collection
     */
    public function getResults(string $term): Collection
    {
        return ServiceCategory::active()
            ->translated()
            ->withTranslation()
            ->whereTranslation('name', 'LIKE', '%' . $term . '%')
            ->get();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return trans('search.services');
    }
}