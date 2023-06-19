<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Data\Transformers\BoolToIntTransformer;
use Squarebit\InvoiceXpress\API\Data\Transformers\BoolToNumericStringTransformer;
use Squarebit\InvoiceXpress\API\Enums\TaxCodeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxRegionEnum;

#[MapName(SnakeCaseMapper::class)]
class TaxData extends EntityData
{
    public const CREATE_PROPERTIES = [
        'name',
        'value',
        'region',
        'code',
        'defaultTax',
    ];

    public function __construct(
        public Optional|int $id,
        public string $name,
        #[WithTransformer(BoolToNumericStringTransformer::class)]
        public Optional|float $value,
        public Optional|TaxRegionEnum $region,
        public Optional|TaxCodeEnum $code,
        #[WithTransformer(BoolToIntTransformer::class)]
        public Optional|bool $defaultTax,
    ) {
    }
}
