<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Packages\Localization\Exceptions;

use Exception;

class MissingConfigDataException extends Exception
{
    /**
     * Name of the config option.
     *
     * @var string
     */
    protected $optionName;

    /**
     * Description of the config option.
     *
     * @var string
     */
    protected $optionDescription;

    /**
     * Set the name and description of the config option.
     *
     * @param string $name
     * @param string $description
     * @return $this
     */
    public function setConfigOption($name, $description)
    {
        $this->optionName = $name;
        $this->optionDescription = $description;

        $this->message = "Option [{$name}] does not exist in config data: {$description}.";

        return $this;
    }

    /**
     * Get the name of config option.
     *
     * @return string
     */
    public function getConfigOptionName()
    {
        return $this->optionName;
    }

    /**
     * Get the description of config option.
     *
     * @return string
     */
    public function getConfigOptionDescription()
    {
        return $this->optionDescription;
    }
}