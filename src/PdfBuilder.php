<?php declare(strict_types=1);

namespace Surda\Pdf;

use Latte\Engine;
use Mpdf\Mpdf;
use Nette\Bridges\ApplicationLatte\Template;

class PdfBuilder
{
    /** @var Template|null */
    protected $template;

    /** @var Mpdf */
    protected $mpdf;

    /**
     * @param Mpdf $mpdf
     */
    public function __construct(Mpdf $mpdf)
    {
        $this->setMpdf($mpdf);
    }

    /**
     * @param mixed[] $parameters
     * @return $this
     */
    public function setParameters(array $parameters): self
    {
        $this->getTemplate()->setParameters($parameters);

        return $this;
    }

    /**
     * @param string $file
     * @return $this
     */
    public function setTemplateFile(string $file): self
    {
        $this->getTemplate()->setFile($file);

        return $this;
    }

    /**
     * @return Template
     */
    public function getTemplate(): Template
    {
        return $this->template ?: $this->template = new Template(new Engine());
    }

    /**
     * @param Template $template
     */
    public function setTemplate(Template $template): void
    {
        $this->template = clone $template;
    }

    /**
     * @param Mpdf $mpdf
     */
    public function setMpdf(Mpdf $mpdf): void
    {
        $this->mpdf = $mpdf;
    }

    /**
     * @return Mpdf
     * @throws \Mpdf\MpdfException
     * @throws \Throwable
     */
    public function getMpdf(): Mpdf
    {
        $mpdf = $this->mpdf;

        $template = $this->getTemplate();

        $mpdf->WriteHTML($template->__toString());

        return $mpdf;
    }
}