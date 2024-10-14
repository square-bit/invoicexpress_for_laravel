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
use Squarebit\InvoiceXpress\Enums\InvoiceStatusEnum;
use Squarebit\InvoiceXpress\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\InvoiceXpress;

#[MapName(SnakeCaseMapper::class)]
class InvoiceData extends EntityData
{
    public const CREATE_PROPERTIES = [
        'date',
        'dueDate',
        'reference',
        'observations',
        'retention',
        'taxExemption',
        'sequenceId',
        'manualSequenceNumber',
        'mbReference',
        'ownerInvoiceId',
        'taxExemptionReason',
        'currencyCode',
        'rate',
    ];

    /**
     * @param  DataCollection<int, ItemData>  $items
     */
    public function __construct(
        public Optional|int $id,
        #[WithCast(EnumCast::class)]
        public Optional|InvoiceStatusEnum $status,
        public Optional|bool $archived,
        public Optional|InvoiceTypeEnum $type,
        public ?string $sequenceId,
        public null|Optional|string $sequenceNumber,
        public null|Optional|string $invertedSequenceNumber,
        public null|Optional|string $manualSequenceNumber,
        public null|Optional|int $ownerInvoiceId,
        public null|Optional|string $atcud,
        #[WithCast(EnumCast::class)]
        public null|Optional|TaxExemptionCodeEnum $taxExemption,
        public null|Optional|TaxExemptionCodeEnum $taxExemptionReason,
        #[WithCast(DateTimeInterfaceCast::class, format: InvoiceXpress::DATE_FORMAT)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: InvoiceXpress::DATE_FORMAT)]
        public ?Carbon $date,
        #[WithCast(DateTimeInterfaceCast::class, format: InvoiceXpress::DATE_FORMAT)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: InvoiceXpress::DATE_FORMAT)]
        public ?Carbon $dueDate,
        public ?string $reference,
        public ?string $observations,
        public ?string $retention,
        public null|Optional|string $permalink,
        public null|Optional|string $saftHash,
        public null|Optional|float $sum,
        public null|Optional|float $discount,
        public null|Optional|float $beforeTaxes,
        public null|Optional|float $taxes,
        public null|Optional|float $total,
        public null|Optional|string $currency,
        public null|Optional|string $currencyCode,
        public null|Optional|float $rate,
        public ClientData $client,
        #[DataCollectionOf(ItemData::class)]
        public DataCollection $items,
        public null|Optional|int|array $mbReference,
    ) {
        $this->date ??= now();
    }

    public static function getCreateProperties(): array
    {
        return array_merge(
            static::CREATE_PROPERTIES,
            static::prefixProperties('items', ItemData::getCreateProperties()),
            static::prefixProperties('client', ClientData::getCreateProperties()),
        );
    }

    public function toCreateData(): static
    {
        return static::from($this)
            ->only(...static::getCreateProperties());
    }
}
