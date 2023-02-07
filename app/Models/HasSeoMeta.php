<?php

namespace App\Models;

/**
 * Trait HasSeoMetas
 * @package App
 */
trait HasSeoMeta
{
    /**
     * @return string|null
     */
    public function getSeoTitleAttribute()
    {
        $translation = $this->getTranslation();

        return $translation->seo_title ?: $translation->name;
    }

    /**
     * @return string|null
     */
    public function getSeoKeywordsAttribute()
    {
        $translation = $this->getTranslation();

        return $translation->seo_keywords ?: $translation->name;
    }

    /**
     * @return string|null
     */
    public function getSeoDescriptionAttribute()
    {
        $translation = $this->getTranslation();

        return $translation->seo_description ?: $translation->name;
    }
}
