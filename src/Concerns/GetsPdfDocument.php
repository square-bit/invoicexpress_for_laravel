<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\API\Data\PdfData;

trait GetsPdfDocument
{
    protected int $getPdfMaxRetries = 3;

    public function getGetPdfMaxRetries(): int
    {
        return $this->getPdfMaxRetries;
    }

    public function setGetPdfMaxRetries(int $getPdfMaxRetries): static
    {
        $this->getPdfMaxRetries = $getPdfMaxRetries;

        return $this;
    }

    public function getPdf(bool $secondCopy = false): ?PdfData
    {
        $endpoint = $this->getEndpoint();

        $i = 0;
        while (true) {
            if ($i++ === $this->getPdfMaxRetries) {
                return null;
            }

            $pdfData = $endpoint->generatePDF($this->id, $secondCopy);

            if ($pdfData === null || $endpoint->getResponseCode() !== 200) {
                sleep(1);

                continue;
            }

            return $pdfData;
        }
    }
}
