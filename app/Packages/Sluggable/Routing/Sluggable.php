<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Routing;

use App\Packages\Sluggable\Contracts\Routing\Handler;
use App\Packages\Sluggable\Routing\Exceptions\HandlerClassNotExistsException;
use App\Packages\Sluggable\Routing\Exceptions\InvalidHandlerException;
use App\Packages\Sluggable\Routing\Exceptions\MissingArrayOfHandlersException;
use App\Packages\Sluggable\Routing\Exceptions\MissingConfigFileException;
use Illuminate\Contracts\Foundation\Application;

class Sluggable
{
    /**
     * Illuminate app instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Current locale.
     *
     * @var
     */
    protected $currentLocale;

    /**
     * Slug handlers.
     *
     * @var array
     */
    protected $handlers = [];

    /**
     * Instances of slug handlers.
     *
     * @var array
     */
    protected $handlersInstances = [];

    /**
     * Handlers used by next dispatching.
     *
     * @var array
     */
    protected $onlyHandlers = [];

    /**
     * Handlers excluded by next dispatching.
     *
     * @var array
     */
    protected $exceptHandlers = [];

    /**
     * Create a new Sluggable object.
     *
     * Sluggable constructor.
     * @param Application $app
     * @param null $currentLocale
     */
    public function __construct(Application $app, $currentLocale = null)
    {
        $this->app = $app;
        $this->currentLocale = $currentLocale;
        $this->setHandlers();
    }

    /**
     * Set sluggable handlers.
     *
     * @throws HandlerClassNotExistsException
     * @throws MissingArrayOfHandlersException
     * @throws MissingConfigFileException
     */
    protected function setHandlers()
    {
        if (!$this->app->config->has('sluggable')) {
            throw new MissingConfigFileException;
        }

        $handlers = $this->app->config->get('sluggable.handlers');

        if (!is_array($handlers)) {
            throw new MissingArrayOfHandlersException;
        }

        foreach ($handlers as $handlerName => $handler) {
            $this->setHandler($handlerName, $handler);
        }
    }

    /**
     * Set handler class.
     *
     * @param string $handlerName
     * @param string $handler
     * @throws HandlerClassNotExistsException
     */
    protected function setHandler($handlerName, $handler)
    {
        if (!class_exists($handler)) {
            throw (new HandlerClassNotExistsException)->setHandlerClass($handler);
        }

        $this->handlers[$handlerName] = $handler;
    }

    /**
     * Get handler instance.
     *
     * @param string $handlerName
     * @param string $handlerClass
     * @return Handler|bool
     * @throws InvalidHandlerException
     */
    protected function getHandlerInstance($handlerName, $handlerClass)
    {
        if ($this->onlyHandlers && !in_array($handlerName, $this->onlyHandlers, true)) {
            return false;
        }

        if ($this->exceptHandlers && in_array($handlerName, $this->exceptHandlers, true)) {
            return false;
        }

        if (array_key_exists($handlerName, $this->handlersInstances)) {
            return $this->handlersInstances[$handlerName];
        }

        $this->setHandlerInstance($handlerName, $handlerClass);

        return $this->handlersInstances[$handlerName];
    }

    /**
     * Set a handler instance.
     *
     * @param string $handlerName
     * @param string $handlerClass
     * @throws InvalidHandlerException
     */
    protected function setHandlerInstance($handlerName, $handlerClass)
    {
        $handler = new $handlerClass;

        if (!$handler instanceof Handler) {
            throw (new InvalidHandlerException)->setInvalidAndContractHandlers(
                $handlerClass,
                Handler::class
            );
        }

        $this->handlersInstances[$handlerName] = $handler;
    }

    /**
     * Specify a subset of handlers to be used on next dispatching.
     *
     * @param array $handlers
     * @return $this
     */
    public function only(array $handlers = [])
    {
        $this->onlyHandlers = $handlers;

        return $this;
    }

    /**
     * Specify a subset of handlers to be excluded on next dispatching.
     *
     * @param array $handlers
     * @return $this
     */
    public function except(array $handlers = [])
    {
        $this->exceptHandlers = $handlers;

        return $this;
    }

    /**
     * Clear the conditions from last dispatching.
     */
    private function clearTempConditions()
    {
        $this->onlyHandlers = [];
        $this->exceptHandlers = [];
    }

    /**
     * Get the ControllerBag according to slugs, otherwise false.
     *
     * @param array $slugs
     * @return ControllerBag|false
     */
    public function dispatch($slugs)
    {
        $slugCollection = (new SlugCollectionGenerator)->generate($slugs);

        $controllerBag = false;

        foreach ($this->handlers as $handlerName => $handlerClass) {
            if (false === $handler = $this->getHandlerInstance($handlerName, $handlerClass)) {
                continue;
            }

            if (false === $controllerBag = $handler->handle($slugCollection)) {
                continue;
            }

            break;
        }

        $this->clearTempConditions();

        return $controllerBag;
    }
}