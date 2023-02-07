<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Packages\EloquentTaggable\Taggable\TagTrait;

/**
 * Class PageTag
 *
 * @package App
 */
class PageTag extends Model
{
    use TagTrait;

    /**
     * Fillable fields of a tag.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
