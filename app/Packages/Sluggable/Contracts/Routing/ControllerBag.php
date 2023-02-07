<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Contracts\Routing;

interface ControllerBag
{
    /**
     * Get the controller class.
     *
     * @return string
     */
    public function controller();

    /**
     * Get the method from controller.
     *
     * @return array
     */
    public function method();

    /**
     * Get the arguments for method call.
     *
     * @return array
     */
    public function arguments();
}