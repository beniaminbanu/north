<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing\Exceptions;

use Exception;

class InvalidHandlerException extends Exception
{
    /**
     * Class name of invalid handler.
     *
     * @var string
     */
    protected $invalidHandlerClass;

    /**
     * Class name of handler contract.
     *
     * @var string
     */
    protected $handlerContractClass;

    /**
     * Set the classes names of invalid handler and handler contract.
     *
     * @param string $invalidHandlerClass
     * @param string $handlerContractClass
     * @return $this
     */
    public function setInvalidAndContractHandlers($invalidHandlerClass, $handlerContractClass)
    {
        $this->invalidHandlerClass = $invalidHandlerClass;
        $this->handlerContractClass = $handlerContractClass;

        $this->message = "[{$invalidHandlerClass}] class must implement the Handler contract [{$handlerContractClass}]";

        return $this;
    }

    /**
     * Get the class name of invalid handler.
     *
     * @return string
     */
    public function getInvalidHandlerClass()
    {
        return $this->invalidHandlerClass;
    }

    /**
     * Get the class name of handler contract.
     *
     * @return string
     */
    public function getHandlerContractClass()
    {
        return $this->handlerContractClass;
    }
}