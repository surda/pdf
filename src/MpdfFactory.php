<?php declare(strict_types=1);

namespace Surda\Pdf;

use Mpdf\Mpdf;
use Mpdf\MpdfException;

class MpdfFactory
{
    private array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @throws MpdfException
     */
    public function create(): Mpdf
    {
        return new Mpdf($this->config);
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }
}