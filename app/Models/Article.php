<?php

namespace App\Models;

use App\Concerns\Models\ScopeStatus;
use App\Http\Searchable\Searchable;
use App\Http\Searchable\SearchResult;
use App\Packages\Localization\Facades\Localization;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Models\ScopeListedBySlug;
use App\Packages\EloquentTranslatable\TranslatableTrait;
use Illuminate\Support\Str;

/**
 * Class Article
 * @package App
 */
class Article extends Model implements Searchable
{
    use HasSeoMeta,
        ScopeStatus,
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
     * @var array
     */
    protected $fillable = ['order', 'published_at', 'status'];

    /**
     * @var array
     */
    protected $casts = [
        'published_at' => 'date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            ArticleCategory::class,
            'articles_to_category',
            'article_id',
            'category_id'
        );
    }

    /**
     * @return string
     */
    public function getImagePathAttribute()
    {
        return $this->image ? asset('upload/' . $this->image) : null;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getPathAttribute()
    {
        $page = page('ArticlesController');

        return url(implode('/', array_filter([
            $page ? $page->path : Localization::getRoutePrefix(),
            Str::slug($this->getTranslation()->slug)
        ])));
    }

    /**
     * @return Article[]
     */
    public static function getSidebarArticles()
    {
        return self::active()
            ->translated()
            ->with('categories.translation')
            ->withTranslation()
            ->whereIsBoxes(true)
            ->orderBy('order')
            ->get();
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
