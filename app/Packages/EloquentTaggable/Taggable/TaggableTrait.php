<?php

/**
 *
 * @author dragosandreidinu
 *
 */

namespace App\Packages\EloquentTaggable\Taggable;

use App\Models\PageTag;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait TaggableTrait
{
    use EloquentTaggableTrait;

    /**
     * Indicates if the pivot should be timestamped.
     *
     * @var bool
     */
    protected $taggablePivotWithTimestamps = false;

    /**
     * Get the tags associated with the given taggable.
     *
     * @return BelongsToMany
     */
    public function tags()
    {
        $belongsToMany = $this->belongsToMany(
            $this->getTagModelName(),
            $this->getTaggablePivotTable(),
            $this->getTaggableForeignKey(),
            $this->getTagForeignKey()
        );

        if ($this->taggablePivotWithTimestamps) {
            $belongsToMany->withTimestamps();
        }

        return $belongsToMany;
    }

    /**
     * Check if the model is associated with a tag.
     *
     * @param mixed $tag
     * @return bool
     */
    public function hasTag($tag)
    {
        return $this->tags->contains(function ($value) use ($tag) {
            return in_array($tag, [
                $value->getAttribute($this->getTagNameColumn()),
                $value->pivot->getAttribute($this->getTagForeignKey())
            ]);
        });
    }

    /**
     * Get an associated tag.
     *
     * @param mixed $tag
     * @return PageTag|null
     */
    public function getTag($tag)
    {
        $key = $this->tags->search(function ($value) use ($tag) {
            return in_array($tag, [
                $value->getAttribute($this->getTagNameColumn()),
                $value->pivot->getAttribute($this->getTagForeignKey())
            ]);
        });

        if ($key !== false) {
            return $this->tags[$key];
        }

        return null;
    }

    /**
     * Attach tag to taggable. Returns true if the tag was attached.
     *
     * @param number|string $tag
     * @return bool
     */
    public function attachTag($tag)
    {
        if ($this->hasTag($tag)) {
            return false;
        }

        if (false === $tag = $this->tagIdIsNumericOrFindId($tag)) {
            return false;
        }

        $this->tags()->attach($tag);

        return true;
    }

    /**
     * Detach tag from taggable. Returns true if the tag was detached.
     *
     * @param number|string $tag
     * @return bool
     */
    public function detachTag($tag)
    {
        if (!$this->hasTag($tag)) {
            return false;
        }

        if (false === $tag = $this->tagIdIsNumericOrFindId($tag)) {
            return false;
        }

        $this->tags()->detach($tag);

        return true;
    }

    /**
     * Get an array of ids for associated tags.
     *
     * @return mixed
     */
    public function getTagIdList()
    {
        return $this->tags->pluck('id')->toArray();
    }

    /**
     * Get an array of id-name pairs for associated tags.
     *
     * @return array
     */
    public function getTagList()
    {
        return $this->tags->pluck('name', 'id')->toArray();
    }

    /**
     * Scope query to select only if it is tagged.
     *
     * @param $query
     * @param number|string|array $tag
     * @return mixed
     */
    public function scopeTaggedTo($query, $tag)
    {
        if (!is_array($tag)) {
            $tag = [$tag];
        }

        return $query->whereHas('tags', function ($q) use ($tag) {
            $q->whereIn($this->prepareTagColumn('id'), $tag)
                ->orWhereIn($this->prepareTagColumn($this->getTagNameColumn()), $tag);
        });
    }

    /**
     * Scope queries to eager load tags.
     *
     * @param $query
     * @param $tags
     * @return mixed
     */
    public function scopeWithTags($query, $tags)
    {
        if (!is_array($tags)) {
            $tags = [$tags];
        }

        return $query->with(['tags' => function ($q) use ($tags) {
            $q->whereIn($this->prepareTagColumn('id'), $tags)
                ->orWhereIn($this->prepareTagColumn($this->getTagNameColumn()), $tags);
        }]);
    }

    /**
     * Scope queries to eager load all tags.
     *
     * @param $query
     * @return mixed
     */
    public function scopeWithAllTags($query)
    {
        return $query->with(['tags']);
    }
}
