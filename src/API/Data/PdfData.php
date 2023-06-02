<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Data;

class PdfData extends Data
{
    public function __construct(
        public ?string $pdfUrl,
        public ?bool $signed,
    ) {
    }
}
