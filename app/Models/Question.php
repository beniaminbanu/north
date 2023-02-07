<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Packages\EloquentTranslatable\TranslatableTrait;

/**
 * Class Question
 * @package App
 */
class Question extends Model
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
    protected $fillable = ['order', 'status', 'is_home'];

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
}
