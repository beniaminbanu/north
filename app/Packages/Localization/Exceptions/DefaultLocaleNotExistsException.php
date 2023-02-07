<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Localization\Exceptions;

use Exception;

class DefaultLocaleNotExistsException extends Exception
{
    /**
     * Default locale.
     *
     * @var string
     */
    protected $defaultLocale;

    /**
     * Set the default locale.
     *
     * @param $locale
     * @return $this
     */
    public function setDefaultLocale($locale)
    {
        $this->defaultLocale = $locale;

        $this->message = "Default locale [{$locale}] is not set in the locales list";

        return $this;
    }

    /**
     * Get the default locale.
     *
     * @return string
     */
    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }
}