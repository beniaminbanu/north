<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Http\SluggableHandlers\Page\Exceptions;

use InvalidArgumentException;

class PageActionNotExistsException extends InvalidArgumentException
{
    /**
     * Name of controller.
     *
     * @var string
     */
    protected $controllerName;

    /**
     * Name of action.
     *
     * @var string
     */
    protected $actionName;

    /**
     * Set the names of controller and action.
     *
     * @param string $controllerName
     * @return $this
     */
    public function setControllerAndActionNames($controllerName, $actionName)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;

        $this->message = "[$actionName] method does not exist in [$controllerName] page controller class";

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

    /**
     * Get the name of action.
     *
     * @return string
     */
    public function getActionName()
    {
        return $this->actionName;
    }
}