<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Models\Casts\TaxCast;

class IxItem extends IxModel
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Item;

    protected string $dataClass = ItemData::class;

    protected $casts = [
        'tax' => TaxCast::class,
    ];

    public function getEndpoint(): ItemsEndpoint
    {
        return new ItemsEndpoint();
    }
}
