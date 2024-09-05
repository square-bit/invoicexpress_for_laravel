<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

/**
 * @property null|string $description
 * @property null|string $name
 * @property null|array $tax
 * @property null|string $unit
 * @property null|float $unit_price
 *
 * @template-extends IxModel<ItemData>
 */
class IxItem extends IxModel
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Item;

    protected string $dataClass = ItemData::class;

    protected $casts = [
        'tax' => TaxData::class,
    ];

    public function getEndpoint(): ItemsEndpoint
    {
        return new ItemsEndpoint;
    }
}
