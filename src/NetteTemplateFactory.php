<?php declare(strict_types=1);

namespace Surda\Pdf;

use Nette\Application\UI\TemplateFactory;
use Nette\Bridges\ApplicationLatte\Template;

class NetteTemplateFactory extends AbstractTemplateFactory
{
    private TemplateFactory $templateFactory;

    public function __construct(TemplateFactory $templateFactory)
    {
        $this->templateFactory = $templateFactory;
    }

    public function create(): Template
    {
        /** @var Template $template */
        $template = $this->templateFactory->createTemplate();

        // Prepare template
        $template = $this->prepare($template);

        return $template;
    }
}