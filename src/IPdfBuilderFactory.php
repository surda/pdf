<?php declare(strict_types=1);

namespace Surda\Pdf;

interface IPdfBuilderFactory
{
    /**
     * @return PdfBuilder
     */
    public function create(): PdfBuilder;
}
