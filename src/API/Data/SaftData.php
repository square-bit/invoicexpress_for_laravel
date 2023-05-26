<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class SaftData extends EntityData
{
    public function __construct(
        public Optional|string $url,
        public Optional|string $message,
    ) {
    }
}
