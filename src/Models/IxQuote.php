<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\EstimateData;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\EstimateStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\EstimateTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;

class IxQuote extends IxModel
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Quote;

    protected string $dataClass = EstimateData::class;

    protected $table = 'ix_estimates';

    protected $casts = [
        'status' => EstimateStatusEnum::class,
        'type' => EstimateTypeEnum::class,
        'tax_exemption' => TaxExemptionCodeEnum::class,
        'client' => 'json',
        'items' => 'array',
        'mb_reference' => 'json',
    ];

    protected array $dates = [
        'date' => 'date:d/m/Y',
        'due_date' => 'date:d/m/Y',
    ];

    public function getEndpoint(): EstimatesEndpoint
    {
        return new EstimatesEndpoint();
    }
}
