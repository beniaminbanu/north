<?php

namespace App\Modules\Mailer;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Email
 *
 * @package App
 */
class EmailTemplate extends Model
{
    /**
     * Value for status "on" state.
     *
     * @var string
     */
    const STATUS_ON = 'active';

    /**
     * Value for status "off" state.
     *
     * @var string
     */
    const STATUS_OFF = 'inactive';

    /**
     * Value for extend "on" state.
     *
     * @var string
     */
    const EXTEND_ON = 1;

    /**
     * Value for extend "off" state.
     *
     * @var string
     */
    const EXTEND_OFF = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'locale',
        'template',
        'from_name',
        'from_address',
        'subject',
        'content',
        'extend',
        'status'
    ];

    /**
     * Scope query to get email templates with status active.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ON);
    }

    /**
     * Scope query to get extended email templates.
     *
     * @param $query
     * @return mixed
     */
    public function scopeExtended($query)
    {
        return $query->where('extend', self::EXTEND_ON);
    }

    /**
     * Scope query to get simple email templates.
     *
     * @param $query
     * @return mixed
     */
    public function scopeSimple($query)
    {
        return $query->where('extend', self::EXTEND_OFF);
    }

    /**
     * Scope query to get email templates with locale.
     *
     * @param $query
     * @param $locale
     *
     * @return mixed
     */
    public function scopeLocale($query, $locale = null)
    {
        if (is_null($locale)) {
            $locale = App::getLocale();
        }

        return $query->where('locale', $locale);
    }

    /**
     * Get template by template otherwise fail.
     *
     * @param      $template
     * @param null $locale
     *
     * @return mixed
     */
    public static function findByTemplate($template, $locale = null)
    {
        return self::where('template', $template)->active()->locale($locale)->firstOrFail();
    }

    /**
     * Set template attribute.
     *
     * @param string $value
     *
     * @return void
     */
    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = Str::snake($value);
    }
}
