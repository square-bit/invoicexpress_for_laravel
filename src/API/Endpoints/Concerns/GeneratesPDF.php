<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\PdfData;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

trait GeneratesPDF
{
    public const GENERATE_PDF = 'generate-pdf';

    private const PDF_ROOT_OBJECT_KEY = 'output';

    /**
     * @throws RequestException|UnknownAPIMethodException
     */
    public function generatePDF(int $id, bool $secondCopy = false): ?PdfData
    {
        $data = $this->call(
            action: static::GENERATE_PDF,
            urlParams: compact('id'),
            queryParams: ['second_copy' => $secondCopy ? 'true' : 'false']
        );

        return is_null($data)
            ? null
            : PdfData::from($data[self::PDF_ROOT_OBJECT_KEY]);
    }
}
