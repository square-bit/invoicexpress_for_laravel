<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PdfData extends EntityData
{
    public function __construct(
        public ?string $pdfUrl,
        public ?bool $signed,
    ) {
    }
}
