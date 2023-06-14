<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\GuideData;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\GuideStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\GuideTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\Concerns\CancelsDocument;
use Squarebit\InvoiceXpress\Concerns\DeletesDocument;
use Squarebit\InvoiceXpress\Concerns\EmailsDocument;
use Squarebit\InvoiceXpress\Concerns\FinalizesDocument;
use Squarebit\InvoiceXpress\Concerns\GetsPdfDocument;
use Squarebit\InvoiceXpress\Concerns\HasClient;
use Squarebit\InvoiceXpress\Concerns\HasItems;

class IxAbstractGuide extends IxModel
{
    use EmailsDocument;
    use FinalizesDocument;
    use DeletesDocument;
    use CancelsDocument;
    use GetsPdfDocument;
    use HasClient;
    use HasItems;

    protected $casts = [
        'type' => GuideTypeEnum::class,
        'status' => GuideStatusEnum::class,
        'tax_exemption' => TaxExemptionCodeEnum::class,
        'tax_exemption_reason' => TaxExemptionCodeEnum::class,
        'client' => 'json',
        'items' => 'array',
        'address_from' => 'json',
        'address_to' => 'json',
        'date' => 'date:d/m/Y',
        'due_date' => 'date:d/m/Y',
        'loaded_at' => 'datetime:d/m/y H:i:s',
    ];

    protected string $dataClass = GuideData::class;

    protected $table = 'ix_guides';

    public function getEndpoint(): GuidesEndpoint
    {
        return new GuidesEndpoint();
    }
}
