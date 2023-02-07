<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing\Exceptions;

use RuntimeException;

class SlugNameExistsInSlugCollectionException extends RuntimeException
{
    /**
     * Duplicate name.
     *
     * @var string
     */
    protected $duplicateName;

    /**
     * Set the name of duplicate slug.
     *
     * @param string $duplicateName
     * @return $this
     */
    public function setDuplicateName($duplicateName)
    {
        $this->duplicateName = $duplicateName;

        $this->message = "[{$duplicateName}] slug already exists in collection";

        return $this;
    }

    /**
     * Get the name of duplicate slug.
     *
     * @return string
     */
    public function getDuplicateName()
    {
        return $this->duplicateName;
    }
}