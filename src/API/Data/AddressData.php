<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Squarebit\InvoiceXpress\API\Enums\CountryEnum;

#[MapName(SnakeCaseMapper::class)]
class AddressData extends EntityData
{
    public function __construct(

        public ?CountryEnum $country,
        public ?string $postalCode,
        public ?string $detail,
        public ?string $city,
    ) {
    }
}
