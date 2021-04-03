<?php declare(strict_types=1);

namespace Surda\Pdf;

class PdfBuilderFactory implements IPdfBuilderFactory
{
    private MpdfFactory $mpdfFactory;
    private IPdfTemplateFactory $templateFactory;

    public function __construct(MpdfFactory $mpdfFactory, IPdfTemplateFactory $templateFactory)
    {
        $this->mpdfFactory = $mpdfFactory;
        $this->templateFactory = $templateFactory;
    }

    /**
     * @throws \Mpdf\MpdfException
     */
    public function create(): PdfBuilder
    {
        $builder = new PdfBuilder($this->mpdfFactory->create());
        $builder->setTemplate($this->templateFactory->create());

        return $builder;
    }
}