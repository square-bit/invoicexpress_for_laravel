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
        'tax.name',
    ];

    public const USE_PROPERTIES = [
        'name',
        'description',
        'unitPrice',
        'unit',
        'quantity',
        'tax.name',
    ];

    public const MODEL_PROPERTIES = [
        'id',
        'name',
        'description',
        'unitPrice',
        'unit',
        'quantity',
        'tax.*',
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
    ) {
    }

    public function toCreateData(): static
    {
        return static::from($this)
            ->only(...self::CREATE_PROPERTIES);
    }

    public function toUpdateData(): static
    {
        return static::from($this)
            ->only(
                'id',
                ...self::CREATE_PROPERTIES
            );
    }

    public function toModelData(): static
    {
        return static::from($this)
            ->only(
                'id',
                ...self::MODEL_PROPERTIES
            );
    }

    public static function getUseProperties(): array
    {
        return self::USE_PROPERTIES;
    }
}
