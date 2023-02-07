<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing;

use App\Packages\Sluggable\Contracts\Routing\ControllerBag;
use App\Packages\Sluggable\Contracts\Routing\Handler as HandlerContract;
use App\Packages\Sluggable\Contracts\Routing\HandlerChain as HandlerChainContract;
use App\Packages\Sluggable\Contracts\Routing\SlugCollection;

abstract class HandlerChain implements HandlerContract, HandlerChainContract
{
    /**
     * Array of chained handlers.
     *
     * @var array
     */
    protected $handlers = [];

    /**
     * Default handlers.
     *
     * @var array
     */
    protected $defaultHandlers = [];

    /**
     * Create a new HandlerChain object.
     */
    public function __construct()
    {
        foreach ($this->defaultHandlers as $handler) {
            $this->attach(new $handler);
        }
    }

    /**
     * Return a ControllerBag object if the given slug
     * collection match conditions, otherwise false.
     *
     * @param SlugCollection $slugCollection
     * @return ControllerBag|bool
     */
    public function handle(SlugCollection $slugCollection)
    {
        foreach ($this->handlers as $handler) {
            if (false !== $controllerBag = $handler->handle($slugCollection)) {
                return $controllerBag;
            }
        }

        return false;
    }

    /**
     * Attach a new handler to chain. Return false the handler already exists.
     *
     * @param HandlerContract $handler
     * @return true
     */
    public function attach(HandlerContract $handler)
    {
        if (!in_array($handler, $this->handlers, true)) {
            $this->handlers[] = $handler;

            return true;
        }

        return false;
    }

    /**
     * Detach a handler from chain. Return false if the handler not exists.
     *
     * @param HandlerContract $handler
     * @return true
     */
    public function detach(HandlerContract $handler)
    {
        if (false !== $key = array_search($handler, $this->handlers, true)) {
            unset($this->handlers[$key]);

            return true;
        }

        return false;
    }
}