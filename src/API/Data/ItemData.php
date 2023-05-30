<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class ItemData extends EntityData
{
    public function __construct(
        public Optional|int $id,
        public string $name,
        public ?string $description,
        public string $unitPrice,
        public ?string $unit,
        public TaxData $tax,
    ) {
    }
}
