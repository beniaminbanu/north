<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Setting
 *
 * @package App
 */
class Setting extends Model
{
    /**
     * Value for "off" state.
     *
     * @var string
     */
    const STATUS_ON = 'active';

    /**
     * Value for "on" state.
     *
     * @var string
     */
    const STATUS_OFF = 'inactive';

    /**
     * Accepted fillable fields.
     *
     * @var array
     */
    protected $fillable = ['key', 'value', 'status'];

    /**
     * Scope query to get settings with status active.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('status', self::STATUS_ON);
    }

    /**
     * Scope query to get settings with status inactive.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeInactive(Builder $query)
    {
        return $query->where('status', self::STATUS_OFF);
    }
}
