<?php

namespace App\Concerns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait ScopeListedBySlug
 * @package App\Concerns\Models
 */
trait ScopeListedBySlug
{
    /**
     * Get a model by slug. The model must be active
     * and translated in current locale.
     *
     * @param Builder $query
     * @param string $slug
     * @return Model|null
     */
    public function scopeListedBySlug(Builder $query, string $slug = null)
    {
        return $query->active()
            ->translated()
            ->withTranslation()
            ->whereTranslation('slug', '=', $slug);
    }
}