<?php

namespace App\Http\Searchable;

/**
 * Class Search
 * @package App\Http\Searchable
 */
class Search
{
    /**
     * @var array
     */
    protected $aspects = [];

    /**
     * @return Search
     */
    public static function new()
    {
        return new self();
    }

    /**
     * @param $searchAspect
     * @return Search
     */
    public function registerAspect($searchAspect): self
    {
        if (is_string($searchAspect)) {
            $searchAspect = app($searchAspect);
        }

        $this->aspects[$searchAspect->getType()] = $searchAspect;

        return $this;
    }

    /**
     * @return array
     */
    public function getSearchAspects(): array
    {
        return $this->aspects;
    }

    /**
     * @param string $query
     * @return SearchResultCollection
     */
    public function search(string $query): SearchResultCollection
    {
        return $this->perform($query);
    }

    /**
     * @param string $query
     * @return SearchResultCollection
     */
    public function perform(string $query): SearchResultCollection
    {
        $searchResults = new SearchResultCollection();

        collect($this->getSearchAspects())->each(function (SearchAspect $aspect) use ($query, $searchResults) {
            $searchResults->addResults($aspect->getType(), $aspect->getResults($query));
        });

        return $searchResults;
    }
}
