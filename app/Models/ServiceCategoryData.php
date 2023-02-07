<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Packages\EloquentTranslatable\TranslationTrait;

/**
 * Class ProjectCategoryData
 * @package App
 */
class ServiceCategoryData extends Model
{
    use TranslationTrait;

    protected $table = 'services_category_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_category_id',
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
