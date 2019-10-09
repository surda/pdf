<?php declare(strict_types=1);

namespace Surda\Pdf\DI;

use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use stdClass;
use Surda\Pdf\IPdfBuilderFactory;
use Surda\Pdf\IPdfTemplateFactory;
use Surda\Pdf\MpdfFactory;
use Surda\Pdf\NetteTemplateFactory;
use Surda\Pdf\PdfBuilderFactory;

/**
 * @property-read stdClass $config
 */
class PdfExtension extends CompilerExtension
{
    public function getConfigSchema(): Schema
    {
        $parameters = $this->getContainerBuilder()->parameters;
        $tempDir = array_key_exists('tempDir', $parameters) ? $parameters['tempDir'] . '/cache/mpdf' : NULL;

        return Expect::structure([
            'mpdf' => Expect::arrayOf('mixed')->default([
                'tempDir' => $tempDir,
            ]),
            'template' => Expect::structure([
                'defaults' => Expect::arrayOf('mixed')->default([
                    'layout' => '@@default',
                ]),
                'config' => Expect::arrayOf('mixed')->default([
                    'layout' => '@@default',
                ]),
            ]),
        ]);
    }

    public function loadConfiguration(): void
    {
        $builder = $this->getContainerBuilder();
        $config = $this->config;

        $builder->addDefinition($this->prefix('mpdfFactory'))
            ->setFactory(MpdfFactory::class, [$config->mpdf]);

        $builder->addDefinition($this->prefix('builderFactory'))
            ->setType(IPdfBuilderFactory::class)
            ->setFactory(PdfBuilderFactory::class);

        $templateFactory = $builder->addDefinition($this->prefix('templateFactory'))
            ->setType(IPdfTemplateFactory::class)
            ->setFactory(NetteTemplateFactory::class);

        if ($config->template->defaults) {
            $templateFactory->addSetup('setDefaults', [$config->template->defaults]);
        }

        if ($config->template->config) {
            $templateFactory->addSetup('setConfig', [$config->template->config]);
        }
    }
}