<?php

namespace App\Http\Searchable\Aspects;

use App\Project;
use Illuminate\Support\Collection;
use App\Http\Searchable\SearchAspect;

/**
 * Class ProjectAspect
 * @package App\Http\Searchable\Aspects
 */
class ProjectAspect extends SearchAspect
{
    /**
     * @param string $term
     * @return Collection
     */
    public function getResults(string $term): Collection
    {
        return Project::active()
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
        return trans('search.projects');
    }
}