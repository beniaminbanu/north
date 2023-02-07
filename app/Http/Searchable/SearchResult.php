<?php

namespace App\Http\Searchable;

/**
 * Class SearchResult
 * @package App\Http\Searchable
 */
class SearchResult
{
    /**
     * @var Searchable
     */
    protected $searchable;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string|null
     */
    public $url;

    /**
     * @var string|null
     */
    public $type;

    /**
     * SearchResult constructor.
     * @param Searchable $searchable
     * @param string $title
     * @param null|string $url
     */
    public function __construct(Searchable $searchable, string $title, ?string $url = null)
    {
        $this->searchable = $searchable;
        $this->title = $title;
        $this->url = $url;
    }

    /**
     * @param string $type
     * @return SearchResult
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}