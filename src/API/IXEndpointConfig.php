<?php

namespace Squarebit\InvoiceXpress\API;

class IXEndpointConfig
{
    protected ?array $endpointData = null;

    public function __construct(
        public string $object,
        public string $action,
    ) {
        $this->endpointData = IXEndpointsConfig::get($object . '.' . $action);
    }

    public function getMethod(): string
    {
        return $this->endpointData['method'];
    }

    public function getReturns(): ?array
    {
        return $this->endpointData['returns'] ?? null;
    }

    public function getThrows(): ?array
    {
        return $this->endpointData['throws'] ?? null;
    }

    public function getUrl(?array $queryParams = null): string
    {
        $url = 'https://'.
            config('invoicexpress-for-laravel.account.name').
            '.'.
            config('invoicexpress-for-laravel.service_endpoint').
            '/'.
            $this->endpointData['path'];

        if (filled($queryParams)) {
            $url .= '?'.http_build_query($queryParams);
        }

        return $url;
    }
}
