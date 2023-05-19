<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\Enums\InvoiceTypeEnum;

trait IXApiGeneratePDF
{
    public const GENERATE_PDF = 'generate-pdf';

    /**
     * @throws RequestException
     */
    public function generatePDF(InvoiceTypeEnum $type, int $id): array
    {
        return $this->call(
            action: static::SEND_BY_EMAIL,
            urlParams: [
                'type' => $type->value,
                'id' => $id,
            ]);
    }
}
