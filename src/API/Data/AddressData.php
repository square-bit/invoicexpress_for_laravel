<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Squarebit\InvoiceXpress\Enums\CountryEnum;

#[MapName(SnakeCaseMapper::class)]
class AddressData extends Data
{
    public function __construct(

        public ?CountryEnum $country,
        public ?string $postalCode,
        public ?string $detail,
        public ?string $city,
    ) {
    }
}
