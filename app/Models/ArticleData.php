<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Packages\EloquentTranslatable\TranslationTrait;

class ArticleData extends Model
{
    use TranslationTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'article_id',
        'locale',
        'slug',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'name',
        'title',
        'short_description',
        'description'
    ];
}
