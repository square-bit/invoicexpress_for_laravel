<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Endpoints\TaxesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\TaxCodeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxRegionEnum;

class IxTax extends IxModel
{
    protected string $dataClass = TaxData::class;

    protected $casts = [
        'region' => TaxRegionEnum::class,
        'code' => TaxCodeEnum::class,
    ];

    protected function getEndpoint(): TaxesEndpoint
    {
        return new TaxesEndpoint();
    }
}
