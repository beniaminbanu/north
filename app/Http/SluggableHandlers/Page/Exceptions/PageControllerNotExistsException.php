<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Http\SluggableHandlers\Page\Exceptions;

use InvalidArgumentException;

class PageControllerNotExistsException extends InvalidArgumentException
{
    /**
     * Name of controller.
     *
     * @var string
     */
    protected $controllerName;

    /**
     * Set the name of controller.
     *
     * @param string $controllerName
     * @return $this
     */
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;

        $this->message = "[$controllerName] page controller does not exist";

        return $this;
    }

    /**
     * Get the name of controller.
     *
     * @return string
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }
}