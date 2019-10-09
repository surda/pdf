<?php declare(strict_types=1);

namespace Surda\Pdf;

use Nette\Bridges\ApplicationLatte\Template;

interface IPdfTemplateFactory
{
    /**
     * @return Template
     */
    public function create(): Template;
}