<?php

namespace Squarebit\InvoiceXpress\API;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

/**
 * @template TData of Data
 */
abstract class IXEndpoint
{
    protected ?int $lastResponseCode;

    /**
     * @return TData
     */
    abstract protected function responseToDataObject(array $data): Data;

    abstract protected function getEndpointName(): string;

    abstract protected function getEntityType(): DocumentTypeEnum;

    abstract protected function getJsonRootObjectKey(): string;

    public function getEndpointConfig(string $action): IXEndpointConfig
    {
        return new IXEndpointConfig($this->getEndpointName(), $action);
    }

    /**
     * @throws RequestException | UnknownAPIMethodException
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
     * @throws RequestException|UnknownAPIMethodException
     */
    public function call(string $action, array $urlParams = [], array $queryParams = [], array $bodyData = []): ?array
    {
        $response = $this->request($action, $urlParams, $queryParams, $bodyData);
        $this->lastResponseCode = $response->status();

        return $response
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

    public function getResponseCode(): ?int
    {
        return $this->lastResponseCode;
    }
}
