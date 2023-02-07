<?php

namespace App\Concerns\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait ScopeStatus
 * @package App\Concerns\Models
 */
trait ScopeStatus
{
    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', static::ENUM_ACTIVE);
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeInactive(Builder $builder)
    {
        return $builder->where('status', static::ENUM_INACTIVE);
    }
}