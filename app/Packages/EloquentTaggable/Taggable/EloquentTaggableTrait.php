<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\EloquentTaggable\Taggable;

use Illuminate\Support\Str;

trait EloquentTaggableTrait
{
    /**
     * Get the suffix of tag model.
     *
     * @return string
     */
    public function getTagModelSuffix()
    {
        return 'Tag';
    }

    /**
     * Get the of column that stores the tag name (value).
     *
     * @return string
     */
    public function getTagNameColumn()
    {
        return 'name';
    }

    /**
     * Check if this is the taggable model.
     *
     * @return bool
     */
    public function isTaggableModel()
    {
        return !$this->isTagModel();
    }

    /**
     * Check if this is the tag model.
     *
     * @return bool
     */
    public function isTagModel()
    {
        return Str::endsWith(
            class_basename($this),
            $this->getTagModelSuffix()
        );
    }

    /**
     * Get the name of taggable model.
     *
     * @return string
     */
    public function getTaggableModelName()
    {
        if ($this->isTagModel()) {
            return Str::replaceLast($this->getTagModelSuffix(), '', get_class($this));
        }

        return get_class();
    }

    /**
     * Get the name of tag model.
     *
     * @return string
     */
    public function getTagModelName()
    {
        if ($this->isTaggableModel()) {
            return get_class($this).$this->getTagModelSuffix();
        }

        return get_class();
    }

    /**
     * Get the name of taggable table.
     *
     * @return string
     */
    public function getTaggableTable()
    {
        if ($this->isTagModel()) {
            return app()->make($this->getTaggableModelName())->getTable();
        }

        return $this->getTable();
    }

    /**
     * Get the name of tag table.
     *
     * @return string
     */
    public function getTagTable()
    {
        if ($this->isTaggableModel()) {
            return app()->make($this->getTagModelName())->getTable();
        }

        return $this->getTable();
    }

    /**
     * Get the name of pivot table.
     *
     * @return  string
     */
    public function getTaggablePivotTable()
    {
        return $this->getTaggableTable().'_to_tags';
    }

    /**
     * Get the foreign key of taggable.
     *
     * @return string
     */
    public function getTaggableForeignKey()
    {
        $className = class_basename($this);

        if ($this->isTagModel()) {
            $className = $this->getTaggableModelName();
        }

        return Str::snake(class_basename($className)).'_id';
    }

    /**
     * Get the foreign key of tag.
     *
     * @return string
     */
    public function getTagForeignKey()
    {
        return 'tag_id';
    }

    /**
     * Concat the name of taggable table with the column name. The
     * method accepts a column name or an array of columns names.
     *
     * @param string|array $column
     * @return string
     */
    public function prepareTaggableColumn($column)
    {
        if (is_array($column)) {
            return array_map(function ($value) {
                return $this->getTaggableTable().'.'.$value;
            }, $column);
        }

        return $this->getTaggableTable().'.'.$column;
    }

    /**
     * Concat the name of tag table with the column name. The method
     * accepts a column name or an array of columns names.
     *
     * @param string|array $column
     * @return string
     */
    public function prepareTagColumn($column)
    {
        if (is_array($column)) {
            return array_map(function ($value) {
                return $this->getTagTable().'.'.$value;
            }, $column);
        }

        return $this->getTagTable().'.'.$column;
    }

    /**
     * Concat the name of pivot table with the column name. The method
     * accepts a column name or an array of columns names.
     *
     * @param string|array $column
     * @return string
     */
    public function prepareTaggablePivotColumn($column)
    {
        if (is_array($column)) {
            return array_map(function ($value) {
                return $this->getTaggablePivotTable().'.'.$value;
            }, $column);
        }

        return $this->getTaggablePivotTable().'.'.$column;
    }

    /**
     * Get the tag model by name.
     *
     * @param $tagName
     * @return mixed
     */
    protected function findTagModelByName($tagName)
    {
        $tagModel = $this->getTagModelName();

        return $tagModel::whereTagName($tagName)->first();
    }

    /**
     * Check if tag id is numeric or return the id by tag name.
     *
     * @param number|string $tagId
     * @return number|null
     */
    protected function tagIdIsNumericOrFindId($tagId)
    {
        if (is_numeric($tagId)) {
            return $tagId;
        }

        if (!$tag = $this->findTagModelByName($tagId)) {
            return null;
        }

        return $tag->id;
    }
}