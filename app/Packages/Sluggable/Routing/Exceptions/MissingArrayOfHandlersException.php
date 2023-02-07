<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing\Exceptions;

use Exception;

class MissingArrayOfHandlersException extends Exception
{
    /**
     * Create a new missing array of handlers file exception.
     *
     * @param string $message
     */
    public function __construct($message = 'You must add an array of handlers in sluggable config file.')
    {
        parent::__construct($message);
    }
}