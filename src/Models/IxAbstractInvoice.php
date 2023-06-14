<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\InvoiceStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\Concerns\CancelsDocument;
use Squarebit\InvoiceXpress\Concerns\DeletesDocument;
use Squarebit\InvoiceXpress\Concerns\EmailsDocument;
use Squarebit\InvoiceXpress\Concerns\FinalizesDocument;
use Squarebit\InvoiceXpress\Concerns\GetsPdfDocument;
use Squarebit\InvoiceXpress\Concerns\HasClient;
use Squarebit\InvoiceXpress\Concerns\HasItems;
use Squarebit\InvoiceXpress\Concerns\SettlesDocument;
use Squarebit\InvoiceXpress\Models\Casts\ClientCast;
use Squarebit\InvoiceXpress\Models\Casts\ItemsCast;

class IxAbstractInvoice extends IxModel
{
    use EmailsDocument;
    use FinalizesDocument;
    use CancelsDocument;
    use DeletesDocument;
    use SettlesDocument;
    use GetsPdfDocument;
    use HasClient;
    use HasItems;

    protected EntityTypeEnum $entityType;

    protected string $dataClass = InvoiceData::class;

    protected $table = 'ix_invoices';

    protected $casts = [
        'status' => InvoiceStatusEnum::class,
        'type' => InvoiceTypeEnum::class,
        'tax_exemption' => TaxExemptionCodeEnum::class,
        'tax_exemption_reason' => TaxExemptionCodeEnum::class,
        'date' => 'date:d/m/Y',
        'due_date' => 'date:d/m/Y',
        'client' => ClientCast::class,
        'items' => ItemsCast::class,
        'mb_reference' => 'json',
    ];

    protected $appends = [
        'client',
        'items',
    ];

    public function getEndpoint(): InvoicesEndpoint
    {
        return new InvoicesEndpoint();
    }
}
