<?php declare(strict_types=1);

namespace Surda\Pdf;

use Latte\Engine;
use Mpdf\Mpdf;
use Nette\Bridges\ApplicationLatte\Template;
use Surda\Pdf\Utils\Templater;

class PdfBuilder
{
    protected Template $template;
    protected Mpdf $mpdf;

    public function __construct(Mpdf $mpdf)
    {
        $this->mpdf = $mpdf;
        $this->template = new Template(new Engine());
    }

    public function setParameters(array $parameters): self
    {
        Templater::setParameters($this->template, $parameters);

        return $this;
    }

    public function setTemplateFile(string $file): self
    {
        $this->getTemplate()->setFile($file);

        return $this;
    }

    public function getTemplate(): Template
    {
        return $this->template;
    }

    public function setTemplate(Template $template): void
    {
        $this->template = clone $template;
    }

    public function setMpdf(Mpdf $mpdf): void
    {
        $this->mpdf = $mpdf;
    }

    /**
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