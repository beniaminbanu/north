<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Localization;

use App\Packages\Localization\Exceptions\DefaultLocaleNotExistsException;
use App\Packages\Localization\Exceptions\MissingConfigDataException;
use App\Packages\Localization\Exceptions\MissingConfigFileException;
use Illuminate\Contracts\Foundation\Application;

class Localization
{
    /**
     * Current locale.
     *
     * @var string
     */
    protected $locale = null;

    /**
     * Default locale.
     *
     * @var string
     */
    protected $defaultLocale;

    /**
     * Accepted locales.
     *
     * @var array
     */
    protected $acceptedLocales;

    /**
     * Route prefix for localization.
     *
     * @var string|null
     */
    protected $routePrefix = null;

    /**
     * Hide url segment for localization.
     *
     * @var bool
     */
    protected $hideDefaultLocaleUrlSegment = true;

    /**
     * Illuminate app instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Creates a new Localization object.
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->registerConfigData();
    }

    /**
     * Store the config data.
     *
     * @throws DefaultLocaleNotExistsException
     * @throws MissingConfigDataException
     * @throws MissingConfigFileException
     */
    private function registerConfigData()
    {
        if (!$this->app->config->has('localization')) {
            throw new MissingConfigFileException;
        }

        foreach ([
             'default_locale' => 'default locale used by application',
             'locales' => 'accepted locales saved as array of locale-options pairs',
             'hide_default_locale_url_segment' => 'boolean value to hide the url segment for localization'
        ] as $option => $description) {
            if (!$this->app->config->has("localization.{$option}")) {
                throw (new MissingConfigDataException)->setConfigOption($option, $description);
            }
        }

        $this->acceptedLocales = $this->app->config->get('localization.locales');
        $this->defaultLocale = $this->app->config->get('localization.default_locale');
        $this->hideDefaultLocaleUrlSegment = $this->app->config->get('localization.hide_default_locale_url_segment');

        if (!$this->hasLocale($this->defaultLocale)) {
            throw (new DefaultLocaleNotExistsException)->setDefaultLocale($this->defaultLocale);
        }
    }

    /**
     * Check if current locale is set.
     *
     * @return bool
     */
    private function ready()
    {
        return $this->locale != null;
    }

    /**
     * Set the current locale if it is not already set.
     */
    private function prepare()
    {
        if (!$this->ready()) {
            $this->setLocale();
        }
    }

    /**
     * Check if the given locale exists.
     *
     * @param string $locale
     * @return bool
     */
    public function hasLocale($locale)
    {
        return array_key_exists($locale, $this->acceptedLocales);
    }

    /**
     * Set and get the current locale.
     *
     * @param null|string $locale
     * @return string
     */
    public function setLocale($locale = null)
    {
        $this->locale = $this->defaultLocale;

        if (empty($locale) || !is_string($locale)) {
            $locale = $this->app->request->segment(1);
        }

        if ($this->hasLocale($locale)) {
            $this->locale = $locale;
        }

        $this->setRoutePrefix();

        $this->app->setLocale($this->locale);

        if ($regional = $this->getCurrentLocaleRegional()) {
            setlocale(LC_TIME, $regional.'.UTF-8');
            setlocale(LC_MONETARY, $regional.'.UTF-8');
            setlocale(LC_NUMERIC, 'en_GB');
        }

        return $this->locale;
    }

    /**
     * Get default locale.
     *
     * @return string
     */
    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    /**
     * Get the current locale.
     *
     * @return string
     */
    public function getCurrentLocale()
    {
        $this->prepare();

        return $this->locale;
    }

    /**
     * Get name of current locale.
     *
     * @return string
     */
    public function getCurrentLocaleName()
    {
        return $this->acceptedLocales[$this->locale]['name'];
    }

    /**
     * Get native of current locale.
     *
     * @return string
     */
    public function getCurrentLocaleNative()
    {
        return $this->acceptedLocales[$this->locale]['native'];
    }

    /**
     * Get regional of current locale.
     *
     * @return string
     */
    public function getCurrentLocaleRegional()
    {
        return $this->acceptedLocales[$this->locale]['regional'];
    }

    /**
     * Get an array of accepted locales.
     *
     * @return array
     */
    public function getAllLocales()
    {
        return array_keys($this->acceptedLocales);
    }

    /**
     * Get an array of accepted locales.
     *
     * @return array
     */
    public function getAcceptedLocales()
    {
        return $this->acceptedLocales;
    }

    /**
     * Checks if hide the url segment for default locale.
     *
     * @return bool
     */
    public function hideDefaultLocaleUrlSegment()
    {
        return $this->hideDefaultLocaleUrlSegment;
    }

    /**
     * Set the current route prefix.
     */
    protected function setRoutePrefix()
    {
        $segments = $this->app->request->segments();

        $locale = $segments ? $segments[0] : null;

        $this->routePrefix = null;

        if ($this->hasLocale($locale)) {
            $this->routePrefix = $locale;
        }
    }

    /**
     * Get route prefix for the current locale.
     *
     * @return null|string
     */
    public function getRoutePrefix()
    {
        $this->prepare();

        return $this->routePrefix;
    }
}