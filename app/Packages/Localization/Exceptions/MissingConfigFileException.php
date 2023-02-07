<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Localization\Exceptions;

use Exception;

class MissingConfigFileException extends Exception
{
    /**
     * Create a new missing config file exception.
     *
     * @param string $message
     */
    public function __construct($message = 'Missing config file. Create the localization.php file in config folder.')
    {
        parent::__construct($message);
    }
}