<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Config;

use Exception;

class EndpointConfig
{
    protected ?array $endpointData = null;

    public function __construct(
        public string $object,
        public string $action,
    ) {
        throw_unless(
            is_array($cfg = EndpointsConfig::get($object.'.'.$action)),
            Exception::class,
            "Endpoints config '".$object.'.'.$action."' must be an array"
        );

        $this->endpointData = $cfg;
    }

    public function getMethod(): string
    {
        return $this->endpointData['method'];
    }

    public function getUrl(?array $queryParams = []): string
    {
        $queryParams = array_merge(
            ['api_key' => config('invoicexpress-for-laravel.account.api_key')],
            $queryParams
        );

        return 'https://'.
            config('invoicexpress-for-laravel.account.name').
            '.'.
            config('invoicexpress-for-laravel.service_endpoint').
            '/'.
            $this->endpointData['path'].
            '?'.
            http_build_query($queryParams);
    }
}
