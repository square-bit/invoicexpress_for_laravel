<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ItemData extends EntityData
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $description,
        public float $unitPrice,
        public ?string $unit,
        public TaxData $tax,
    ) {
    }
}
