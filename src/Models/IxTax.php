<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Endpoints\TaxesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxCodeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxRegionEnum;

/**
 * @template-extends IxModel<TaxData>
 */
class IxTax extends IxModel
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Tax;

    protected string $dataClass = TaxData::class;

    protected $casts = [
        'region' => TaxRegionEnum::class,
        'code' => TaxCodeEnum::class,
    ];

    public function getEndpoint(): TaxesEndpoint
    {
        return new TaxesEndpoint();
    }
}
