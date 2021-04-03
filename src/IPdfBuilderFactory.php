<?php declare(strict_types=1);

namespace Surda\Pdf;

interface IPdfBuilderFactory
{
    public function create(): PdfBuilder;
}
