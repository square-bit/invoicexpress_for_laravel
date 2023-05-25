<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class PdfData extends EntityData
{
    public function __construct(
        public Optional|string $pdfUrl,
        public Optional|bool $message,
    ) {
    }
}
