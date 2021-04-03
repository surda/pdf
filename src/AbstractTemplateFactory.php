<?php declare(strict_types=1);

namespace Surda\Pdf;

use Nette\Bridges\ApplicationLatte\Template;
use Nette\Utils\Strings;
use Surda\Pdf\Exception\TemplateException;
use Surda\Pdf\Utils\Templater;

abstract class AbstractTemplateFactory implements IPdfTemplateFactory
{
    protected array $defaults = [
        'layout' => '@default',
    ];

    protected array $config = [
        'layout' => '@default',
    ];

    public function setDefaults(array $defaults): void
    {
        $this->defaults = $defaults;
    }

    public function setDefaultsItem(mixed $key, mixed $value): void
    {
        $this->defaults[$key] = $value;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    public function setConfigItem(mixed $key, mixed $value): void
    {
        $this->config[$key] = $value;
    }

    protected function prepare(Template $template): Template
    {
        $template = $this->prepareDefaults($template);
        $template = $this->prepareConfig($template);

        return $template;
    }

    protected function prepareDefaults(Template $template): Template
    {
        // Layout
        if (isset($this->defaults['layout'])) {
            $this->defaults['layout'] = $this->prepareLayout($this->defaults['layout']);
        }

        // Append defaults to template
        Templater::addParameter($template, '_defaults', (object) $this->defaults);

        return $template;
    }

    protected function prepareConfig(Template $template): Template
    {
        // Layout
        if (isset($this->config['layout'])) {
            $this->config['layout'] = $this->prepareLayout($this->config['layout']);
        }

        // Append defaults to template
        Templater::addParameter($template, '_config', (object) $this->config);


        return $template;
    }

    protected function prepareLayout(string $layout): string
    {
        if (Strings::startsWith($layout, '@')) {
            $layout = __DIR__ . '/../resources/layouts/' . $layout;
        }

        $layout = Strings::replace($layout, '#.latte$#', '') . '.latte';

        if (!file_exists($layout)) {
            throw new TemplateException(sprintf('Layout file "%s" not found', $layout));
        }

        return $layout;
    }
}