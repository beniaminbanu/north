<?php

namespace App\Packages\EloquentTranslatable;

use Illuminate\Support\Str;

/**
 * Trait TranslationTrait.
 *
 * @package App\Packages\EloquentTranslatable
 * @author dragosandreidinu
 */
trait TranslationTrait
{
    use EloquentTranslatableTrait;

    /**
     * A translation belongs to a translatable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translatable()
    {
        $related = $this->getTranslatableModelName();

        return $this->belongsTo($related, $this->getTranslationForeignKey($related));
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        if (isset($this->table)) {
            return $this->table;
        }

        $table = explode('_', str_replace('\\', '', Str::snake(class_basename($this))));
        $table[0] = Str::plural($table[0]);

        return implode('_', $table);
    }
}