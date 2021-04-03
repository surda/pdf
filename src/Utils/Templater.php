<?php

namespace Surda\Pdf\Utils;

use Nette\Bridges\ApplicationLatte\Template;
use Nette\Utils\Arrays;

class Templater
{
    /**
     * @param Template $template
     * @param string $name
     * @param mixed $value
     * @return Template
     */
    public static function addParameter(Template $template, string $name, mixed $value): Template
    {
        if (property_exists($template, $name)) {
            throw new \RuntimeException("The variable '$name' already exists.");
        }

        $template->$name = $value;

        return $template;
    }

    /**
     * @param Template $template
     * @param array $parameters
     * @return Template
     */
    public static function addParameters(Template $template, array $parameters): Template
    {
        foreach ($parameters as $key => $value) {
            self::addParameter($template, $key, $value);
        }

        return $template;
    }

    /**
     * @param Template $template
     * @param string $name
     * @param mixed $value
     * @return Template
     */
    public static function setParameter(Template $template, string $name, mixed $value): Template
    {
        Arrays::toObject([$name => $value], $template);

        return $template;
    }

    /**
     * @param Template $template
     * @param array $parameters
     * @return Template
     */
    public static function setParameters(Template $template, array $parameters): Template
    {
        Arrays::toObject($parameters, $template);

        return $template;
    }
}