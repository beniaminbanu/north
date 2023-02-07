<?php

namespace App\Packages\EloquentTranslatable;

use Illuminate\Support\Str;

/**
 * Trait EloquentTranslatableTrait.
 *
 * @package App\Packages\EloquentTranslatable
 * @author dragosandreidinu
 */
trait EloquentTranslatableTrait
{
    /**
     * Get the suffix of translation model.
     *
     * @return string
     */
    public function getTranslationModelSuffix()
    {
        return 'Data';
    }

    /**
     * Get the name of locale column from translation table.
     *
     * @return string
     */
    public function getTranslationLocaleColumn()
    {
        return 'locale';
    }

    /**
     * Check if this is the translatable model.
     *
     * @return bool
     */
    public function isTranslatableModel()
    {
        return !Str::endsWith(
            class_basename($this),
            $this->getTranslationModelSuffix()
        );
    }

    /**
     * Check if this is the translation model.
     *
     * @return bool
     */
    public function isTranslationModel()
    {
        return !$this->isTranslatableModel();
    }

    /**
     * Get the foreign key used to join the translatable with translation.
     *
     * @return string
     */
    public function getTranslationForeignKey()
    {
        $className = class_basename($this);

        if ($this->isTranslationModel()) {
            $className = $this->getTranslatableModelName();
        }

        return Str::snake(class_basename($className)).'_id';
    }

    /**
     * Get the name of translatable model.
     *
     * @return string
     */
    public function getTranslatableModelName()
    {
        if ($this->isTranslationModel()) {
            return Str::replaceLast($this->getTranslationModelSuffix(), '', get_class($this));
        }

        return get_class();
    }

    /**
     * Get the name of translation model.
     *
     * @return string
     */
    public function getTranslationModelName()
    {
        if ($this->isTranslatableModel()) {
            return get_class($this).$this->getTranslationModelSuffix();
        }

        return get_class();
    }

    /**
     * Get the name of translatable table.
     *
     * @return string
     */
    public function getTranslatableTable()
    {
        if ($this->isTranslationModel()) {
            return app()->make($this->getTranslatableModelName())->getTable();
        }

        return $this->getTable();
    }

    /**
     * Get the name of translation table.
     *
     * @return string
     */
    public function getTranslationTable()
    {
        if ($this->isTranslatableModel()) {
            return app()->make($this->getTranslationModelName())->getTable();
        }

        return $this->getTable();
    }

    /**
     * Add the name of translatable table before the column
     * name. The method accepts a column name or an array
     * of columns names.
     *
     * @param string|array $column
     * @return string
     */
    public function prepareTranslatableColumn($column)
    {
        if (is_array($column)) {
            return array_map(function ($value) {
                return $this->getTranslatableTable().'.'.$value;
            }, $column);
        }

        return $this->getTranslatableTable().'.'.$column;
    }

    /**
     * Add the name of translation table before the column
     * name. The method accepts a column name or an array
     * of columns names.
     *
     * @param string|array $column
     * @return string
     */
    public function prepareTranslationColumn($column)
    {
        if (is_array($column)) {
            return array_map(function ($value) {
                return $this->getTranslationTable().'.'.$value;
            }, $column);
        }

        return $this->getTranslationTable().'.'.$column;
    }

    /**
     * Get the current locale.
     *
     * @return string
     */
    public function getTranslationCurrentLocale()
    {
        return app()->getLocale();
    }
}