<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Data\Transformers\FloatToStringTransformer;

#[MapName(SnakeCaseMapper::class)]
class ItemData extends EntityData
{
    public const CREATE_PROPERTIES = [
        'name',
        'description',
        'unitPrice',
        'unit',
    ];

    public const UPDATE_PROPERTIES = [
        'id',
        'name',
        'description',
        'unitPrice',
        'unit',
    ];

    public const USE_PROPERTIES = [
        'name',
        'description',
        'unitPrice',
        'unit',
        'quantity',
    ];

    public const MODEL_PROPERTIES = [
        'id',
        'name',
        'description',
        'unitPrice',
        'unit',
        'quantity',
    ];

    public function __construct(
        public Optional|int $id,
        public string $name,
        public ?string $description,
        #[WithTransformer(FloatToStringTransformer::class)]
        public float $unitPrice,
        public ?string $unit,
        public Optional|float $quantity,
        public TaxData $tax,
        public Optional|float $discount,
        public Optional|float $subtotal,
        public Optional|float $tax_amount,
        public Optional|float $discount_amount,
        public Optional|float $total,
    ) {}

    protected static function getCreateProperties(): array
    {
        return array_merge(
            static::CREATE_PROPERTIES,
            static::prefixProperties('tax', TaxData::getUseProperties()),
        );
    }

    protected static function getUseProperties(): array
    {
        return array_merge(
            static::USE_PROPERTIES,
            static::prefixProperties('tax', TaxData::getUseProperties()),
        );
    }
}
