<?php

namespace Squarebit\InvoiceXpress\Models;

use Spatie\LaravelData\DataCollection;
use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\Concerns\CancelsDocument;
use Squarebit\InvoiceXpress\Concerns\DeletesDocument;
use Squarebit\InvoiceXpress\Concerns\EmailsDocument;
use Squarebit\InvoiceXpress\Concerns\FinalizesDocument;
use Squarebit\InvoiceXpress\Concerns\GetsPdfDocument;
use Squarebit\InvoiceXpress\Concerns\GetsQrCode;
use Squarebit\InvoiceXpress\Concerns\HasClient;
use Squarebit\InvoiceXpress\Concerns\HasItems;
use Squarebit\InvoiceXpress\Concerns\SettlesDocument;
use Squarebit\InvoiceXpress\Enums\InvoiceStatusEnum;
use Squarebit\InvoiceXpress\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\Models\Scopes\InvoiceTypeScope;

/**
 * @property ?InvoiceTypeEnum $type
 * @property float $total
 * @property DataCollection<ItemData> $items
 * @property ?ClientData $client
 *
 * @template-extends IxModel<InvoiceData>
 */
class IxAbstractInvoice extends IxModel
{
    use CancelsDocument;
    use DeletesDocument;
    use EmailsDocument;
    use FinalizesDocument;
    use GetsPdfDocument;
    use GetsQrCode;
    use HasClient;
    use HasItems;
    use SettlesDocument;

    protected string $dataClass = InvoiceData::class;

    protected $table = 'ix_invoices';

    protected $casts = [
        'status' => InvoiceStatusEnum::class,
        'type' => InvoiceTypeEnum::class,
        'tax_exemption' => TaxExemptionCodeEnum::class,
        'tax_exemption_reason' => TaxExemptionCodeEnum::class,
        'date' => 'date:d/m/Y',
        'due_date' => 'date:d/m/Y',
        'client' => ClientData::class,
        'items' => DataCollection::class.':'.ItemData::class,
        'mb_reference' => 'json',
    ];

    protected $appends = [
        'client',
        'items',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new InvoiceTypeScope);
    }

    public function getEndpoint(): InvoicesEndpoint
    {
        return new InvoicesEndpoint;
    }

    public function getInvoiceType(): InvoiceTypeEnum
    {
        return InvoiceTypeEnum::from($this->entityType->toStudlyCase());
    }
}
