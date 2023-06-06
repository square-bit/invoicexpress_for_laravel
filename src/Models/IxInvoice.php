<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\InvoiceStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\Concerns\PaysDocument;

class IxInvoice extends IxAbstractInvoice
{
    use PaysDocument;

    protected EntityTypeEnum $entityType = EntityTypeEnum::Invoice;

    protected string $dataClass = InvoiceData::class;

    protected $table = 'ix_invoices';

    protected $casts = [
        'status' => InvoiceStatusEnum::class,
        'type' => InvoiceTypeEnum::class,
        'tax_exemption' => TaxExemptionCodeEnum::class,
        'tax_exemption_reason' => TaxExemptionCodeEnum::class,
        'client' => 'json',
        'items' => 'array',
        'mb_reference' => 'json',
    ];

    protected array $dates = [
        'date' => 'date:d/m/Y',
        'due_date' => 'date:d/m/Y',
    ];

    public function getEndpoint(): InvoicesEndpoint
    {
        return new InvoicesEndpoint();
    }
}
