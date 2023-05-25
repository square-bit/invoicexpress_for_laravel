<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class QRCodeData extends EntityData
{
    public function __construct(
        public ?string $url,
        public Optional|string $status,
    ) {
    }
}
