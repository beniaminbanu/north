<?php

namespace App\Concerns\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait ScopeIsHome
 * @package App\Concerns\Models
 */
trait ScopeIsHome
{
    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeIsHome(Builder $builder)
    {
        return $builder->where('is_home', static::ENUM_ACTIVE);
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeIsNotHome(Builder $builder)
    {
        return $builder->where('is_home', static::ENUM_INACTIVE);
    }
}