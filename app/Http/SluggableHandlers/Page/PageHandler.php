<?php

/**
 * @author dragosandreidinu
 */

namespace App\Http\SluggableHandlers\Page;

use App\Models\Page;
use Illuminate\Support\Facades\View;
use App\Packages\Sluggable\Routing\Handler;
use App\Packages\Sluggable\Routing\ControllerBag;
use App\Packages\Sluggable\Contracts\Routing\Slug;
use App\Http\SluggableHandlers\Page\Exceptions\PageViewNotExistsException;
use App\Http\SluggableHandlers\Page\Exceptions\PageActionNotExistsException;
use App\Http\SluggableHandlers\Page\Exceptions\PageControllerNotExistsException;

/**
 * Class PageHandler
 *
 * @package App\Http\SluggableHandlers\Page
 */
class PageHandler extends Handler
{
    /**
     * Expected slug-type pairs.
     *
     * @var array
     */
    protected $expectedSlugs = [
        'slug' => Slug::class,
    ];

    /**
     * Default controller.
     *
     * @var string
     */
    protected $defaultController = 'PageController';

    /**
     * Default action.
     *
     * @var string
     */
    protected $defaultAction = 'index';

    /**
     * Default view.
     *
     * @var string
     */
    protected $defaultView = 'page';

    /**
     * Namespace of controllers.
     *
     * @var string
     */
    protected $controllersNamespace = 'App\Http\Controllers\Page';

    /**
     * Views folder.
     *
     * @var string
     */
    protected $viewsFolder = 'pages';

    /**
     * Use the current slug collection to create and return
     * a ControllerBag object, or return false.
     *
     * @return \App\Packages\Sluggable\Contracts\Routing\ControllerBag|bool
     */
    protected function makeControllerBag()
    {
        if ($page = Page::listedBySlug($this->slugCollection->getSlug('slug')->getValue())->first()) {
            return $this->compile($page);
        }

        return false;
    }

    /**
     * Compile the page settings to a ControllerBag object.
     *
     * @param Page $page
     *
     * @return ControllerBag
     */
    protected function compile(Page $page)
    {
        $controller = $this->compileController($page->handler_controller);
        $action = $this->compileAction($page->handler_action, $controller);
        $view = $this->compileView($page->handler_view);

        return new ControllerBag($controller, $action, [$page, $view]);
    }

    /**
     * Compile controller name to controller class.
     *
     * @param string $controllerName
     *
     * @return string
     */
    protected function compileController($controllerName)
    {
        $controllerName = $this->getControllerName($controllerName ?: $this->defaultController);

        if (!class_exists($controllerName)) {
            throw (new PageControllerNotExistsException)->setControllerName($controllerName);
        }

        return $controllerName;
    }

    /**
     * Compile action name to controller action.
     *
     * @param string $actionName
     * @param string $controllerClass
     *
     * @return string
     */
    protected function compileAction($actionName, $controllerClass)
    {
        $actionName = $actionName ?: $this->defaultAction;

        if (!method_exists($controllerClass, $actionName)) {
            throw (new PageActionNotExistsException)->setControllerAndActionNames($controllerClass, $actionName);
        }

        return $actionName;
    }

    /**
     * Compile view name to view path.
     *
     * @param string $viewName
     *
     * @return string
     */
    protected function compileView($viewName)
    {
        $viewName = $this->getViewName($viewName ?: $this->defaultView);

        if (!View::exists($viewName)) {
            throw (new PageViewNotExistsException)->setViewName($viewName);
        }

        return $viewName;
    }

    /**
     * Prepend the controllers namespace to the given controller name.
     *
     * @param string $controllerName
     *
     * @return string
     */
    protected function getControllerName($controllerName)
    {
        return $this->controllersNamespace . '\\' . trim($controllerName, '\\');
    }

    /**
     * Prepend the views folder to the given view name.
     *
     * @param string $viewName
     *
     * @return string
     */
    protected function getViewName($viewName)
    {
        return $this->viewsFolder . '.' . trim($viewName, '.');
    }
}
