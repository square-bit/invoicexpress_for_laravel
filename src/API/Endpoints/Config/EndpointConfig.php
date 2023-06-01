<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Config;

class EndpointConfig
{
    protected ?array $endpointData = null;

    public function __construct(
        public string $object,
        public string $action,
    ) {
        $this->endpointData = EndpointsConfig::get($object.'.'.$action);
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
