<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Endpoints\Config\EndpointConfig;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

/**
 * @template T of Data
 */
abstract class Endpoint
{
    protected ?int $lastResponseCode;

    /**
     * @return T
     */
    abstract protected function responseToDataObject(array $data): Data;

    abstract protected function getEndpointName(): string;

    public function getEndpointConfig(string $action): EndpointConfig
    {
        return new EndpointConfig($this->getEndpointName(), $action);
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
        $method = strtolower($endpointConfig->getMethod());

        throw_unless($method, UnknownAPIMethodException::class, "Unknown action '$action'");

        $response = match ($method) {
            'get', 'head' => $this->http()
                ->withUrlParameters($urlParams)
                ->$method($endpointConfig->getUrl($queryParams)),
            default => $this->http()
                ->withUrlParameters($urlParams)
                ->$method($endpointConfig->getUrl($queryParams), $bodyData),
        };
        $this->lastResponseCode = $response->status();

        return $response;
    }

    /**
     * @throws RequestException|UnknownAPIMethodException
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

    public function getResponseCode(): ?int
    {
        return $this->lastResponseCode;
    }
}
