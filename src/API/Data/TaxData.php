<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Enums\TaxCodeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxRegionEnum;

#[MapName(SnakeCaseMapper::class)]
class TaxData extends EntityData
{
    public function __construct(
        public Optional | int $id,
        public string $name,
        public Optional | string $value,
        public Optional | TaxRegionEnum $region,
        public Optional | TaxCodeEnum $code,
        public Optional | bool $defaultTax,
    ) {
    }
}
