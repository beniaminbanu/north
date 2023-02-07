<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\EloquentTaggable\Taggable;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

trait TagTrait
{
    use EloquentTaggableTrait;

    /**
     * Get the taggables associated with the given tag.
     *
     * @return BelongsToMany
     */
    public function tagged()
    {
        return $this->belongsToMany(
            $this->getTaggableModelName(),
            $this->getTaggablePivotTable(),
            $this->getTagForeignKey(),
            $this->getTaggableForeignKey()
        );
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

        $noSuffix = Str::replaceLast($this->getTagModelSuffix(), '', class_basename($this));

        return Str::snake(
            Str::plural($noSuffix).Str::plural($this->getTagModelSuffix())
        );
    }

    /**
     * Scope the query to select the tags with the given name.
     *
     * @param $query
     * @param string $tagName
     * @return mixed
     */
    public function scopeWhereTagName($query, $tagName)
    {
        return $query->where($this->getTagNameColumn(), '=', $tagName);
    }
}