<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AddressData extends EntityData
{
    public function __construct(
        public ?string $country,
        public ?string $postalCode,
        public ?string $detail,
        public ?string $city,
    ) {
    }
}
