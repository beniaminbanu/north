<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Locale
 * @package App
 */
class Locale extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['locale', 'name', 'native', 'regional', 'default', 'status'];

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', true);
    }
}
