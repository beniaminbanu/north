<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing;

use App\Packages\Sluggable\Contracts\Routing\ControllerBag as ControllerBagContract;

class ControllerBag implements ControllerBagContract
{
    /**
     * Controller class.
     *
     * @var string
     */
    protected $controller;

    /**
     * Method from controller.
     *
     * @var string
     */
    protected $method;

    /**
     * Arguments for method call.
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * Create a new ControllerBag object.
     *
     * @param string $controller
     * @param string $method
     * @param array $arguments
     */
    public function __construct($controller, $method, array $arguments = [])
    {
        $this->controller = $controller;
        $this->method = $method;
        $this->arguments = $arguments;
    }

    /**
     * Get the controller class.
     *
     * @return string
     */
    public function controller()
    {
        return $this->controller;
    }

    /**
     * Get the method from controller.
     *
     * @return array
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * Get the arguments for method call.
     *
     * @return array
     */
    public function arguments()
    {
        return $this->arguments;
    }
}