<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\GuideData;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\GuideStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\GuideTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;

class IxShipping extends IxModel
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Shipping;

    protected string $dataClass = GuideData::class;

    protected $table = 'ix_guides';

    protected $casts = [
        'type' => GuideTypeEnum::class,
        'status' => GuideStatusEnum::class,
        'tax_exemption' => TaxExemptionCodeEnum::class,
        'tax_exemption_reason' => TaxExemptionCodeEnum::class,
        'client' => 'json',
        'items' => 'array',
        'address_from' => 'json',
        'address_to' => 'json',
    ];

    protected array $dates = [
        'date' => 'date:d/m/Y',
        'due_date' => 'date:d/m/Y',
        'loaded_at' => 'datetime:d/m/y H:i:s',
    ];

    public function getEndpoint(): GuidesEndpoint
    {
        return new GuidesEndpoint();
    }
}
