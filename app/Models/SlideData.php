<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Packages\EloquentTranslatable\TranslationTrait;

/**
 * Class SlideData
 *
 * @package App
 */
class SlideData extends Model
{
    use TranslationTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slide_id',
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
