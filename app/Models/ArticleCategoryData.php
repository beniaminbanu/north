<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Packages\EloquentTranslatable\TranslationTrait;

/**
 * Class ArticleCategoryData
 * @package App
 */
class ArticleCategoryData extends Model
{
    use TranslationTrait;

    protected $table = 'articles_category_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'article_category_id',
        'locale',
        'slug',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'name',
        'short_description',
        'description'
    ];
}
