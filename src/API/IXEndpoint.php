<?php

namespace Squarebit\InvoiceXpress\API;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;
use Throwable;

/**
 * @template TData of Data
 */
abstract class IXEndpoint
{
    /**
     * @return TData
     */
    abstract protected function responseToDataObject(array $data): Data;

    abstract protected function getEndpointName(): string;

    abstract protected function getEntityType(): EntityTypeEnum;

    abstract protected function getJsonRootObjectKey(): string;

    public function getEndpointConfig(string $action): IXEndpointConfig
    {
        return new IXEndpointConfig($this->getEndpointName(), $action);
    }

    /**
     * @throws Throwable
     */
    public function request(
        string $action,
        array $urlParams = [],
        array $queryParams = [],
        array $bodyData = []
    ): Response {
        $endpointConfig = $this->getEndpointConfig($action);
        $urlParams = $this->getUrlParameters($urlParams);
        $method = strtolower($endpointConfig->getMethod());

        throw_unless($method, UnknownAPIMethodException::class, "Unknown action '$action'");

        return match ($method) {
            'get', 'head' => $this->http()
                ->withUrlParameters($urlParams)
                ->$method($endpointConfig->getUrl($queryParams)),
            default => $this->http()
                ->withUrlParameters($urlParams)
                ->$method($endpointConfig->getUrl($queryParams), $bodyData),
        };
    }

    /**
     * @throws RequestException|Throwable
     */
    public function call(string $action, array $urlParams = [], array $queryParams = [], array $bodyData = []): ?array
    {
        return $this->request($action, $urlParams, $queryParams, $bodyData)
            ->throw()
            ->json();
    }

    protected function http(): PendingRequest
    {
        return Http::acceptJson()
            ->asJson();
    }

    public function getUrlParameters(array $urlParams = []): array
    {
        $urlParams['type'] ??= $this->getEntityType()->value;

        return $urlParams;
    }
}
