<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\EstimateData;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\EstimateStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\EstimateTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\Concerns\AcceptsDocument;
use Squarebit\InvoiceXpress\Concerns\CancelsDocument;
use Squarebit\InvoiceXpress\Concerns\DeletesDocument;
use Squarebit\InvoiceXpress\Concerns\EmailsDocument;
use Squarebit\InvoiceXpress\Concerns\FinalizesDocument;
use Squarebit\InvoiceXpress\Concerns\GetsPdfDocument;
use Squarebit\InvoiceXpress\Concerns\HasClient;
use Squarebit\InvoiceXpress\Concerns\HasItems;
use Squarebit\InvoiceXpress\Concerns\RefusesDocument;

class IxAbstractEstimate extends IxModel
{
    use EmailsDocument;
    use FinalizesDocument;
    use DeletesDocument;
    use AcceptsDocument;
    use RefusesDocument;
    use CancelsDocument;
    use GetsPdfDocument;
    use HasClient;
    use HasItems;

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
        'date' => 'date:d/m/Y',
        'due_date' => 'date:d/m/Y',
    ];

    public function getEndpoint(): EstimatesEndpoint
    {
        return new EstimatesEndpoint();
    }
}
