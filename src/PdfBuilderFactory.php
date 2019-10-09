<?php declare(strict_types=1);

namespace Surda\Pdf;

class PdfBuilderFactory implements IPdfBuilderFactory
{
    /** @var MpdfFactory */
    private $mpdfFactory;

    /** @var IPdfTemplateFactory */
    private $templateFactory;

    /**
     * @param MpdfFactory         $mpdfFactory
     * @param IPdfTemplateFactory $templateFactory
     */
    public function __construct(MpdfFactory $mpdfFactory, IPdfTemplateFactory $templateFactory)
    {
        $this->mpdfFactory = $mpdfFactory;
        $this->templateFactory = $templateFactory;
    }

    /**
     * @return PdfBuilder
     * @throws \Mpdf\MpdfException
     */
    public function create(): PdfBuilder
    {
        $builder = new PdfBuilder($this->mpdfFactory->create());
        $builder->setTemplate($this->templateFactory->create());

        return $builder;
    }
}