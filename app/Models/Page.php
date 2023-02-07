<?php

namespace App\Models;

use App\Concerns\Models\ScopeStatus;
use App\Http\Searchable\Searchable;
use App\Http\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Models\ScopeListedBySlug;
use App\Packages\Localization\Facades\Localization;
use App\Packages\EloquentTranslatable\TranslatableTrait;
use App\Packages\EloquentTaggable\Taggable\TaggableTrait;
use Illuminate\Support\Str;

/**
 * Class Page
 *
 * @package App
 */
class Page extends Model implements Searchable
{
    use HasSeoMeta,
        ScopeStatus,
        TaggableTrait,
        ScopeListedBySlug,
        TranslatableTrait;

    /**
     * @var string
     */
    const ENUM_ACTIVE = 'active';

    /**
     * @var string
     */
    const ENUM_INACTIVE = 'inactive';

    /**
     * @var string
     */
    const TAG_HEADER = 'header';

    /**
     * @var string
     */
    const TAG_FOOTER = 'footer';

    /**
     * @var string
     */
    const TAG_WELCOME = 'welcome';

    /**
     * @var bool
     */
    protected $selected = false;

    /**
     * @var array
     */
    protected $appends = ['path'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['handler_type', 'handler_name', 'handler_action', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicesCategories()
    {
        return $this->hasMany(ServiceCategory::class, 'page_id');
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getPathAttribute()
    {
        $slug = $this->getTranslation();

        if (!$slug) {
            $slug = '';
        } else {
            $slug = $this->getTranslation()->slug;
        }

        return url(implode('/', array_filter([
            $this->parent ? $this->parent->path : Localization::getRoutePrefix(),
            Str::slug($slug)
        ])));
    }

    /**
     * @return Page[]
     */
    public static function getMenuItems()
    {
        return self::active()
            ->translated()
            ->withTranslation()
            ->with([
                'parent' => function ($q) {
                    $q->active()->translated()->withTranslation();
                },
                'childrens'          => function ($q) {
                    $q->with('parent')->active()->translated()->withTranslation()->orderBy('order');
                },
                'servicesCategories' => function ($q) {
                    $q->with('page')->active()->translated()->withTranslation()->orderBy('order');
                }
            ])
            ->taggedTo(self::TAG_HEADER)
            ->orderBy('order')
            ->get();
    }

    /**
     * @return Page[]
     */
    public static function getQuickLinks()
    {
        return self::active()
            ->translated()
            ->withTranslation()
            ->taggedTo(self::TAG_FOOTER)
            ->orderBy('order')
            ->get();
    }

    /**
     * @return Page|null
     */
    public static function getWelcomePage()
    {
        return self::active()
            ->translated()
            ->withTranslation()
            ->taggedTo(self::TAG_WELCOME)
            ->orderBy('order')
            ->first();
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
