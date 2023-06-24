<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Squarebit\InvoiceXpress\Enums\EstimateStatusEnum;
use Squarebit\InvoiceXpress\Enums\EstimateTypeEnum;
use Squarebit\InvoiceXpress\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\InvoiceXpress;

#[MapName(SnakeCaseMapper::class)]
class EstimateData extends EntityData
{
    /**
     * @param  DataCollection<int, ItemData>  $items
     */
    public function __construct(
        public Optional|int $id,
        #[WithCast(EnumCast::class)]
        public Optional|EstimateStatusEnum $status,
        public Optional|bool $archived,
        public Optional|EstimateTypeEnum $type,
        public Optional|string $sequenceNumber,
        public Optional|string $invertedSequenceNumber,
        public Optional|int $autoAddRelatedDocument,
        public Optional|string $atcud,
        public ?string $sequenceId,
        #[WithCast(EnumCast::class)]
        public Optional|TaxExemptionCodeEnum $taxExemption,
        #[WithCast(DateTimeInterfaceCast::class, format: InvoiceXpress::DATE_FORMAT)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: InvoiceXpress::DATE_FORMAT)]
        public Optional|Carbon $date,
        #[WithCast(DateTimeInterfaceCast::class, format: InvoiceXpress::DATE_FORMAT)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: InvoiceXpress::DATE_FORMAT)]
        public Optional|Carbon $dueDate,
        public ?string $reference,
        public ?string $observations,
        public ?string $retention,
        public Optional|string $permalink,
        public Optional|string $saftHash,
        public Optional|string $sum,
        public ?string $discount,
        public Optional|string $beforeTaxes,
        public Optional|string $taxes,
        public Optional|string $total,
        public ?string $currency,
        public ClientData $client,
        #[DataCollectionOf(ItemData::class)]
        public DataCollection $items,
        public ?string $mbReference,
    ) {
    }
}
