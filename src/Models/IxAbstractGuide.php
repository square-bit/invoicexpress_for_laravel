<?php

namespace Squarebit\InvoiceXpress\Models;

use Spatie\LaravelData\DataCollection;
use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Data\GuideData;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\Concerns\CancelsDocument;
use Squarebit\InvoiceXpress\Concerns\DeletesDocument;
use Squarebit\InvoiceXpress\Concerns\EmailsDocument;
use Squarebit\InvoiceXpress\Concerns\FinalizesDocument;
use Squarebit\InvoiceXpress\Concerns\GetsPdfDocument;
use Squarebit\InvoiceXpress\Concerns\GetsQrCode;
use Squarebit\InvoiceXpress\Concerns\HasClient;
use Squarebit\InvoiceXpress\Concerns\HasItems;
use Squarebit\InvoiceXpress\Enums\GuideStatusEnum;
use Squarebit\InvoiceXpress\Enums\GuideTypeEnum;
use Squarebit\InvoiceXpress\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\Models\Scopes\GuideTypeScope;

/**
 * @property ?GuideTypeEnum $type
 * @property float $total
 * @property DataCollection<ItemData> $items
 * @property ?ClientData $client
 *
 * @template-extends IxModel<GuideData>
 */
class IxAbstractGuide extends IxModel
{
    use CancelsDocument;
    use DeletesDocument;
    use EmailsDocument;
    use FinalizesDocument;
    use GetsPdfDocument;
    use GetsQrCode;
    use HasClient;
    use HasItems;

    protected $casts = [
        'type' => GuideTypeEnum::class,
        'status' => GuideStatusEnum::class,
        'tax_exemption' => TaxExemptionCodeEnum::class,
        'tax_exemption_reason' => TaxExemptionCodeEnum::class,
        'client' => ClientData::class,
        'items' => DataCollection::class.':'.ItemData::class,
        'address_from' => 'json',
        'address_to' => 'json',
        'date' => 'date:d/m/Y',
        'due_date' => 'date:d/m/Y',
        'loaded_at' => 'datetime:d/m/y H:i:s',
    ];

    protected string $dataClass = GuideData::class;

    protected $table = 'ix_guides';

    protected static function booted(): void
    {
        static::addGlobalScope(new GuideTypeScope);
    }

    public function getEndpoint(): GuidesEndpoint
    {
        return new GuidesEndpoint;
    }

    public function getGuideType(): GuideTypeEnum
    {
        return GuideTypeEnum::from($this->entityType->toStudlyCase());
    }
}
