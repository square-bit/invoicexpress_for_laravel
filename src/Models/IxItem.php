<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;

class IxItem extends IxModel
{
    protected $casts = [
        'tax' => 'json',
    ];

    protected string $dataClass = ItemData::class;

    protected function getEndpoint(): ItemsEndpoint
    {
        return new ItemsEndpoint();
    }
}
