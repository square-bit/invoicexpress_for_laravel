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
use Squarebit\InvoiceXpress\API\Enums\InvoiceStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\InvoiceXpress;

#[MapName(SnakeCaseMapper::class)]
class InvoiceData extends EntityData
{
    public function __construct(
        public Optional|int $id,
        #[WithCast(EnumCast::class)]
        public Optional|InvoiceStatusEnum $status,
        public Optional|bool $archived,
        public Optional|InvoiceTypeEnum $type,
        public ?string $sequenceId,
        public Optional|string $sequenceNumber,
        public Optional|string $invertedSequenceNumber,
        public Optional|string $manualSequenceNumber,
        public Optional|int $ownerInvoiceId,
        public Optional|string $atcud,
        #[WithCast(EnumCast::class)]
        public Optional|TaxExemptionCodeEnum $taxExemption,
        public Optional|TaxExemptionCodeEnum $taxExemptionReason,
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
        public Optional|float $sum,
        public Optional|float $discount,
        public Optional|float $beforeTaxes,
        public Optional|float $taxes,
        public Optional|float $total,
        public Optional|string $currency,
        public Optional|string $currencyCode,
        public Optional|float $rate,
        public ClientData $client,
        #[DataCollectionOf(ItemData::class)]
        public DataCollection $items,
        public Optional|int|array $mbReference,
    ) {
    }
}
