<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\Enums\ClientSendOptionsEnum;
use Squarebit\InvoiceXpress\Enums\TaxExemptionCodeEnum;

#[MapName(SnakeCaseMapper::class)]
class ClientData extends EntityData
{
    public const USE_PROPERTIES = [
        'name',
        'description',
        'unitPrice',
        'unit',
        'quantity',
        //        'tax.name',
    ];

    public function __construct(
        public Optional|int $id,
        public string $name,
        public null|Optional|string $code,
        public null|Optional|string $language,
        public null|Optional|string $email,
        public null|Optional|string $address,
        public null|Optional|string $city,
        public null|Optional|string $postalCode,
        public null|Optional|string $fiscalId,
        public null|Optional|string $website,
        public null|Optional|string $country,
        public null|Optional|string $phone,
        public null|Optional|string $fax,
        public null|Optional|array $preferredContact,
        public null|Optional|string $observations,
        #[WithCast(EnumCast::class)]
        public null|Optional|ClientSendOptionsEnum $sendOptions,
        public null|Optional|string $paymentDays,
        #[WithCast(EnumCast::class)]
        public null|Optional|TaxExemptionCodeEnum $taxExemptionCode,
        public null|Optional|string $openAccountLink,
    ) {}

    public static function getUseProperties(): array
    {
        return self::USE_PROPERTIES;
    }
}
