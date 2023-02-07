<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Sluggable\Contracts\Routing;

interface HandlerChain
{
    /**
     * Attach a new handler to chain.
     *
     * @param Handler $handler
     * @return mixed
     */
    public function attach(Handler $handler);

    /**
     * Detach a handler from chain.
     *
     * @param Handler $handler
     * @return mixed
     */
    public function detach(Handler $handler);
}