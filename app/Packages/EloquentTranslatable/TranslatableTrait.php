<?php

namespace App\Packages\EloquentTranslatable;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait TranslatableTrait.
 *
 * @package App\Packages\EloquentTranslatable
 * @author dragosandreidinu
 */
trait TranslatableTrait
{
    use EloquentTranslatableTrait;

    /**
     * Return translation in current locale.
     *
     * @param string $locale
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translation($locale = null)
    {
        if ($locale == null) {
            $locale = $this->getTranslationCurrentLocale();
        }
        return $this->hasOne($this->getTranslationModelName())->where($this->getTranslationLocaleColumn(), '=', $locale);
    }

    /**
     * A resource can have many translations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany($this->getTranslationModelName());
    }

    /**
     * Check for a translation model for the given locale.
     *
     * @param string|bool $locale
     * @return bool
     */
    public function hasTranslation($locale = false)
    {
        $locale = $locale ?: $this->getTranslationCurrentLocale();

        return $this->translations->contains(function ($value) use ($locale) {
            return $value->getAttribute($this->getTranslationLocaleColumn()) == $locale;
        });
    }

    /**
     * Get the translation model for the given locale.
     *
     * @param string|bool $locale
     * @return Model|null
     */
    public function getTranslation($locale = false)
    {
        $locale = $locale ?: $this->getTranslationCurrentLocale();

        $key = $this->translations->search(function ($value) use ($locale) {
            return $value->getAttribute($this->getTranslationLocaleColumn()) == $locale;
        });

        if ($key !== false) {
            return $this->translations[$key];
        }

        return null;
    }

    /**
     *
     * Scope queries to select only translated resources.
     *
     * @param $query
     * @param bool $locale
     * @return mixed
     */
    public function scopeTranslated($query, $locale = false)
    {
        $locale = $locale ?: $this->getTranslationCurrentLocale();

        return $query->whereHas('translations', function ($q) use ($locale) {
            $q->where($this->prepareTranslationColumn($this->getTranslationLocaleColumn()), $locale);
        });
    }

    /**
     * Scope queries to eager load translations for the given locale.
     *
     * @param $query
     * @param bool $locale
     * @return mixed
     */
    public function scopeWithTranslation($query, $locale = false)
    {
        $locale = $locale ?: $this->getTranslationCurrentLocale();

        return $query->with(['translations' => function ($q) use ($locale) {
            $q->where($this->prepareTranslationColumn($this->getTranslationLocaleColumn()), $locale);
        }]);
    }

    /**
     * Scope queries to check values of a translation field.
     *
     * @param $query
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @param bool $locale
     * @return mixed
     */
    public function scopeWhereTranslation($query, $column, $operator, $value, $locale = false)
    {
        $locale = $locale ?: $this->getTranslationCurrentLocale();

        return $query->whereHas('translations', function ($q) use ($column, $operator, $value, $locale) {
            $q->where($this->prepareTranslationColumn($this->getTranslationLocaleColumn()), $locale)
              ->where($this->prepareTranslationColumn($column), $operator, $value);
        });
    }

    /**
     * Scope queries to check values of multiple translation fields.
     *
     * @param $query
     * @param array $where
     * @param bool $locale
     * @return mixed
     */
    public function scopeWhereAllTranslation($query, array $where, $locale = false)
    {
        $locale = $locale ?: $this->getTranslationCurrentLocale();

        $where = array_prepend($where, [$this->getTranslationLocaleColumn(), '=', $locale]);

        $where = array_map(function ($value) {
            $value[0] = $this->prepareTranslationColumn($value[0]);
            return $value;
        }, $where);

        return $query->whereHas('translations', function ($q) use ($where) {
            foreach ($where as $conditions) {
                $q->where(...$conditions);
            }
        });
    }

    /**
     * Scope query to select from translatable and translation.
     *
     * @param $query
     * @param array $translationColumns
     * @param array $translatableColumns
     * @param bool $locale
     */
    public function scopeListTranslations($query, array $translationColumns, array $translatableColumns = [], $locale = false)
    {
        $locale = $locale ?: $this->getTranslationCurrentLocale();

        $table = $this->getTable();
        $tableKey = $this->getKeyName();
        $relatedTable = $this->getTranslationTable();
        $foreignKey = $this->getTranslationForeignKey();

        if (!in_array($tableKey, $translatableColumns)) {
            $translatableColumns = array_prepend($translatableColumns, $tableKey);
        }

        $translatableColumns = $this->prepareTranslatableColumn($translatableColumns);
        $translationColumns = $this->prepareTranslationColumn($translationColumns);

        $query->select(...array_merge($translatableColumns, $translationColumns))
              ->join($relatedTable, $table.'.'.$tableKey, '=', $relatedTable.'.'.$foreignKey)
              ->where($relatedTable.'.'.$this->getTranslationLocaleColumn(), $locale);
    }
}