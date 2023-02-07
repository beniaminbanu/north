<?php
/**
 *
 * @todo make this middleware after translated routes
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Localization\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Packages\Localization\Facades\Localization;

class LocalizationSessionRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}