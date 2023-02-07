<?php

namespace App\Http\Searchable;

use Illuminate\Support\Collection;

/**
 * Class SearchResultCollection
 * @package App\Http\Searchable
 */
class SearchResultCollection extends Collection
{
    /**
     * @param string $type
     * @param Collection $results
     * @return $this
     */
    public function addResults(string $type, Collection $results)
    {
        $results->each(function ($result) use ($type) {
            /** @var Searchable $result */
            $this->items[] = $result->getSearchResult()->setType($type);
        });

        return $this;
    }

    /**
     * @return Collection
     */
    public function groupByType(): Collection
    {
        return $this->groupBy(function (SearchResult $searchResult) {
            return $searchResult->type;
        });
    }

    /**
     * @param string $aspectName
     * @return Collection
     */
    public function aspect(string $aspectName): Collection
    {
        return $this->groupByType()->get($aspectName);
    }
}