<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\PdfData;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

trait IXApiGeneratePDF
{
    public const GENERATE_PDF = 'generate-pdf';
    private const ROOT_OBJECT_KEY = 'output';

    /**
     * @throws RequestException|UnknownAPIMethodException
     */
    public function generatePDF(int $id): PdfData
    {
        $data = $this->call(
            action: static::GENERATE_PDF,
            urlParams: compact('id'));

        return PdfData::from($data[self::ROOT_OBJECT_KEY]);
    }
}
