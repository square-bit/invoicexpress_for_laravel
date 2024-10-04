<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Data\Transformers\BoolToIntTransformer;
use Squarebit\InvoiceXpress\API\Data\Transformers\BoolToNumericStringTransformer;
use Squarebit\InvoiceXpress\Enums\TaxCodeEnum;
use Squarebit\InvoiceXpress\Enums\TaxRegionEnum;

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
        public null|Optional|TaxRegionEnum $region,
        public null|Optional|TaxCodeEnum $code,
        #[WithTransformer(BoolToIntTransformer::class)]
        public Optional|bool $defaultTax,
    ) {}

    public static function IVA23(): self
    {
        return self::from([
            'name' => 'IVA23',
            'code' => 'NOR',
        ]);
    }

    public static function IVA0(): self
    {
        return self::from([
            'name' => 'IVA0',
            'code' => 'ISE',
        ]);
    }
}
