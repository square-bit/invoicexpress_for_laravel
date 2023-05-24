<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Squarebit\InvoiceXpress\API\Casts\IXDateCast;
use Squarebit\InvoiceXpress\API\Casts\IXTaxExemptionCodeCast;
use Squarebit\InvoiceXpress\API\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\Enums\IXTaxExemptionCodeEnum;

#[MapName(SnakeCaseMapper::class)]
class InvoiceData extends EntityData
{
    public function __construct(
        public ?int $id, // 2137287,
        public ?string $status, // 'final',
        public ?bool $archived, // false,
        public InvoiceTypeEnum $type, // 'Invoice',
        public ?string $sequenceNumber, // '6/G',
        public ?string $invertedSequenceNumber, // 'G/6',
        public ?string $atcud, // 'ABCD1234-6',
        public ?string $sequenceId, // '12345',
        #[WithCast(IXTaxExemptionCodeCast::class)]
        public ?IXTaxExemptionCodeEnum $taxExemption, // 'M00',
        #[WithCast(IXDateCast::class)]
        public ?Carbon $date, // '04/08/2016',
        #[WithCast(IXDateCast::class)]
        public ?Carbon $dueDate, // '19/08/2016',
        public ?string $reference, // 'foo',
        public ?string $observations, // 'foo',
        public ?string $retention, // 'foo',
        public ?string $permalink,
        public ?string $saftHash, // 'J4ay',
        public ?string $sum, // 24.39,
        public ?string $discount, // 0,
        public ?string $beforeTaxes, // 24.39,
        public ?string $taxes, // 5.61,
        public ?string $total, // 30,
        public ?string $currency, // 'Euro',
        public ClientData $client,
        #[DataCollectionOf(ItemData::class)]
        public DataCollection $items,
        public ?string $mbReference,
    ) {
    }
}
