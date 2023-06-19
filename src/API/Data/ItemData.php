<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

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

    public function __construct(
        public Optional|int $id,
        public string $name,
        public ?string $description,
        public string $unitPrice,
        public ?string $unit,
        public ?float $quantity,
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

    public static function getUseProperties(): array
    {
        return self::USE_PROPERTIES;
    }
}
