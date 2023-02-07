<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing\Exceptions;

use Exception;

class HandlerClassNotExistsException extends Exception
{
    /**
     * Name of handler class.
     *
     * @var string
     */
    protected $handlerClass;

    /**
     * Set the name of handler class.
     *
     * @param $handlerClass
     * @return $this
     */
    public function setHandlerClass($handlerClass)
    {
        $this->handlerClass = $handlerClass;

        $this->message = "[{$handlerClass}] class not exists";

        return $this;
    }

    /**
     * Get the name of handler class.
     *
     * @return string
     */
    public function getHandlerClass()
    {
        return $this->handlerClass;
    }
}