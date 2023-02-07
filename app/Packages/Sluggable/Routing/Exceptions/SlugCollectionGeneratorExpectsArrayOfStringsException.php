<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing\Exceptions;

use InvalidArgumentException;

class SlugCollectionGeneratorExpectsArrayOfStringsException extends InvalidArgumentException
{
    /**
     * Create a new SlugCollectionGeneratorExpectsArray exception.
     *
     * @param string $message
     */
    public function __construct($message = 'Generate method from SlugCollectionGenerator expects an array of strings')
    {
        parent::__construct($message);
    }
}