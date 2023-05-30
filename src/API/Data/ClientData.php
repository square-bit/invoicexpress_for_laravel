<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Enums\ClientSendOptionsEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;

#[MapName(SnakeCaseMapper::class)]
class ClientData extends EntityData
{
    public function __construct(
        public Optional|int $id,
        public string $name,
        public ?string $code,
        public ?string $language,
        public ?string $email,
        public ?string $address,
        public ?string $city,
        public ?string $postalCode,
        public ?string $fiscalId,
        public ?string $website,
        public ?string $country,
        public ?string $phone,
        public ?string $fax,
        public ?array $preferredContact,
        public ?string $observations,
        #[WithCast(EnumCast::class)]
        public ?ClientSendOptionsEnum $sendOptions,
        public ?string $paymentDays,
        #[WithCast(EnumCast::class)]
        public ?TaxExemptionCodeEnum $taxExemptionCode,
        public ?string $openAccountLink,
    ) {
    }
}
