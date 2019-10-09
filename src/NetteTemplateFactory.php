<?php declare(strict_types=1);

namespace Surda\Pdf;

use Nette\Application\UI\ITemplateFactory;
use Nette\Bridges\ApplicationLatte\Template;

class NetteTemplateFactory extends AbstractTemplateFactory
{
    /** @var ITemplateFactory */
    private $templateFactory;

    /**
     * @param ITemplateFactory $templateFactory
     */
    public function __construct(ITemplateFactory $templateFactory)
    {
        $this->templateFactory = $templateFactory;
    }

    /**
     * @return Template
     */
    public function create(): Template
    {
        /** @var Template $template */
        $template = $this->templateFactory->createTemplate();

        // Prepare template
        $template = $this->prepare($template);

        return $template;
    }
}