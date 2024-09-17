<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AccountConfig extends Data
{
    public function __construct(
        public string $serviceEndpoint,
        public string $name,
        public string $apiKey,
    ) {}

    public static function default(): self
    {
        $cfg = config('invoicexpress-for-laravel');

        return new self(
            serviceEndpoint: $cfg['service_endpoint'],
            name: $cfg['account']['name'],
            apiKey: $cfg['account']['api_key'],
        );
    }
}
