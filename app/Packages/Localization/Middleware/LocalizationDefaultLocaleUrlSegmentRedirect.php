<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Localization\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Packages\Localization\Facades\Localization;
use Illuminate\Support\Facades\Session;

class LocalizationDefaultLocaleUrlSegmentRedirect
{
    /**
     * The locale from url segment.
     *
     * @var string
     */
    protected $urlLocale = null;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $count_segments = count($request->segments());

        if ($count_segments) {
            $this->setUrlLocale($request);

            switch (true) {
                case $count_segments == 1 && $this->urlLocaleMatchDefaultLocale():
                    $redirect_url = $request->root();
                    break;

                case Localization::hideDefaultLocaleUrlSegment() && $this->urlLocaleMatchDefaultLocale():
                    $redirect_url = $this->buildRedirectUrl($request, false);
                    break;

                case $count_segments && !Localization::hideDefaultLocaleUrlSegment() && !$this->urlHasLocale():
                    $redirect_url = $this->buildRedirectUrl($request, true);
                    break;

                default:
                    $redirect_url = false;
                    break;
            }

            if ($redirect_url) {
                Session::reflash();

                return redirect($redirect_url, 302);
            }
        }

        return $next($request);
    }

    /**
     * Set the locale from url segment.
     *
     * @param Request $request
     */
    protected function setUrlLocale($request)
    {
        $locale = $request->segment(1);

        if (Localization::hasLocale($locale)) {
            $this->urlLocale = $locale;
        }
    }

    /**
     * Check if the url contains locale segment.
     *
     * @return bool
     */
    protected function urlHasLocale()
    {
        return $this->urlLocale !== null;
    }

    /**
     * Check if the locale from url segment is the same with default locale.
     *
     * @return bool
     */
    protected function urlLocaleMatchDefaultLocale()
    {
        return $this->urlLocale == Localization::getDefaultLocale();
    }

    /**
     * Create the redirection url. Make second parameter true to add
     * the default locale to url, or false to remove it from url.
     *
     * @param Request $request
     * @param bool $with_default_locale
     * @return string
     */
    protected function buildRedirectUrl($request, $with_default_locale)
    {
        if (null !== ($query_string = $request->getQueryString())) {
            $query_string = '?'.$query_string;
        }

        $segments = $request->segments();

        if ($with_default_locale) {
            array_unshift($segments, Localization::getDefaultLocale());
        } else {
            array_shift($segments);
        }

        return $request->root().'/'.implode('/', $segments).$query_string;
    }
}