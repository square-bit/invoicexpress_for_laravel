<?php

namespace Squarebit\InvoiceXpress\Models;

use Spatie\LaravelData\DataCollection;
use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Data\EstimateData;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\Concerns\AcceptsDocument;
use Squarebit\InvoiceXpress\Concerns\CancelsDocument;
use Squarebit\InvoiceXpress\Concerns\DeletesDocument;
use Squarebit\InvoiceXpress\Concerns\EmailsDocument;
use Squarebit\InvoiceXpress\Concerns\FinalizesDocument;
use Squarebit\InvoiceXpress\Concerns\GetsPdfDocument;
use Squarebit\InvoiceXpress\Concerns\HasClient;
use Squarebit\InvoiceXpress\Concerns\HasItems;
use Squarebit\InvoiceXpress\Concerns\RefusesDocument;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Enums\EstimateStatusEnum;
use Squarebit\InvoiceXpress\Enums\EstimateTypeEnum;
use Squarebit\InvoiceXpress\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\Models\Scopes\EstimateTypeScope;

/**
 * @property ?EstimateTypeEnum $type
 * @property float $total
 * @property DataCollection<ItemData> $items
 * @property ?ClientData $client
 *
 * @template-extends IxModel<EstimateData>
 */
class IxAbstractEstimate extends IxModel
{
    use AcceptsDocument;
    use CancelsDocument;
    use DeletesDocument;
    use EmailsDocument;
    use FinalizesDocument;
    use GetsPdfDocument;
    use HasClient;
    use HasItems;
    use RefusesDocument;

    protected EntityTypeEnum $entityType = EntityTypeEnum::Quote;

    protected string $dataClass = EstimateData::class;

    protected $table = 'ix_estimates';

    protected $casts = [
        'status' => EstimateStatusEnum::class,
        'type' => EstimateTypeEnum::class,
        'tax_exemption' => TaxExemptionCodeEnum::class,
        'client' => ClientData::class,
        'items' => DataCollection::class.':'.ItemData::class,
        'mb_reference' => 'json',
        'date' => 'date:d/m/Y',
        'due_date' => 'date:d/m/Y',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new EstimateTypeScope);
    }

    public function getEndpoint(): EstimatesEndpoint
    {
        return new EstimatesEndpoint;
    }

    public function getEstimateType(): EstimateTypeEnum
    {
        return EstimateTypeEnum::from($this->entityType->toStudlyCase());
    }
}
