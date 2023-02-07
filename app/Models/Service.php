<?php

namespace App\Models;

use App\Packages\Localization\Facades\Localization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Packages\EloquentTranslatable\TranslatableTrait;

class Service extends Model
{
    use TranslatableTrait;

    /**
     * @var integer
     */
    const STATUS_ON = 1;

    /**
     * @var integer
     */
    const STATUS_OFF = 0;

    /**
     * @var array
     */
    protected $fillable = ['image', 'order',  'status', 'is_home'];

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', self::STATUS_ON);
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeIsHome(Builder $builder)
    {
        return $builder->where('is_home', self::STATUS_ON);
    }

    /**
     * @return string
     */
    public function imagePath()
    {
        return asset('upload/' . $this->image);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            ServiceCategory::class,
            'services_to_categories',
            'service_id',
            'category_id'
        );
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getPathAttribute()
    {
        $category = $this->categories ? $this->categories->first() : null;

        return url(implode('/', array_filter([
            $category ? $category->path : Localization::getRoutePrefix(),
            '#tab-' . $this->id
        ])));
    }

    /**
     * @return Service[]
     */
    public static function getFooterServices()
    {
        return self::active()
            ->translated()
            ->withTranslation()
            ->whereIsFooter(true)
            ->orderBy('footer_order')
            ->get();
    }

    /**
     * @return Service[]
     */
    public static function getRequestServices()
    {
        return self::active()
            ->translated()
            ->withTranslation()
            ->whereIsRequest(true)
            ->orderBy('order')
            ->get();
    }
}
