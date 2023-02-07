<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Http\SluggableHandlers\Page\Exceptions;

use InvalidArgumentException;

class PageViewNotExistsException extends InvalidArgumentException
{
    /**
     * Name of view.
     *
     * @var string
     */
    protected $viewName;

    /**
     * Set the view name.
     *
     * @param string $viewName
     * @return $this
     */
    public function setViewName($viewName)
    {
        $this->viewName = $viewName;

        $this->message = "[$viewName] page view does not exist";

        return $this;
    }

    /**
     * Get the view name.
     *
     * @return string
     */
    public function getViewName()
    {
        return $this->viewName;
    }
}