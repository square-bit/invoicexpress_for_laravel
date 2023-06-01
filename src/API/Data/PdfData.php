<?php

namespace Squarebit\InvoiceXpress\API\Data;

class PdfData extends EntityData
{
    public function __construct(
        public ?string $pdfUrl,
        public ?bool $signed,
    ) {
    }
}
