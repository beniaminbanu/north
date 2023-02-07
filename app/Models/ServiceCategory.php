<?php

namespace App\Models;

use App\Http\Searchable\Searchable;
use App\Concerns\Models\ScopeIsHome;
use App\Concerns\Models\ScopeStatus;
use App\Http\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Models\ScopeListedBySlug;
use App\Packages\Localization\Facades\Localization;
use App\Packages\EloquentTranslatable\TranslatableTrait;
use Illuminate\Support\Str;

/**
 * Class ProjectCategory
 * @package App
 */
class ServiceCategory extends Model implements Searchable
{
    use HasSeoMeta,
        ScopeStatus,
        ScopeIsHome,
        ScopeListedBySlug,
        TranslatableTrait;

    protected $table = 'services_category';

    /**
     * @var integer
     */
    const ENUM_ACTIVE = 'active';

    /**
     * @var integer
     */
    const ENUM_INACTIVE = 'inactive';

    /**
     * @var array
     */
    protected $fillable = ['icon', 'image', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(
            Service::class,
            'services_to_categories',
            'category_id',
            'service_id'
        );
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getPathAttribute()
    {
        return url(implode('/', array_filter([
            $this->page ? $this->page->path : Localization::getRoutePrefix(),
            Str::slug($this->getTranslation()->slug)
        ])));
    }

    /**
     * @return SearchResult
     */
    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->getTranslation()->name,
            $this->path
        );
    }
}
