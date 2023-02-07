<?php

namespace App\Models;

use App\Concerns\Models\ScopeStatus;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Models\ScopeListedBySlug;
use App\Packages\EloquentTranslatable\TranslatableTrait;

/**
 * Class ArticleCategory
 * @package App
 */
class ArticleCategory extends Model
{
    use ScopeStatus;
    use ScopeListedBySlug;
    use TranslatableTrait;

    /**
     * @var string
     */
    protected $table = 'articles_category';

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
    protected $fillable = ['image', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(
            Article::class,
            'articles_to_category',
            'category_id',
            'article_id'
        );
    }
}
