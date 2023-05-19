<?php

namespace Squarebit\InvoiceXpress\Models;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\Exceptions\UnknownAPIMethodException;
use Squarebit\InvoiceXpress\IXEndpoint;

class IXEntity
{
    protected static string $endpointConfig = '';

    public function getEndpoint(string $action): IXEndpoint
    {
        return new IXEndpoint(static::$endpointConfig, $action);
    }

    /**
     * @throws \Throwable
     */
    public function request(string $action, array $urlParams = [], array $queryParams = [], array $bodyData = []): Response
    {
        $endpoint = $this->getEndpoint($action);
        $method = $endpoint->getMethod();

        throw_unless($method, UnknownAPIMethodException::class, "Unknown action '$action'");

        return match ($method) {
            'GET', 'HEAD' => $this->http()
                ->withUrlParameters($urlParams)
                ->$method(
                    $endpoint->getUrl(),
                    array_merge(
                        ['api_key' => config('invoicexpress-for-laravel.account.api_key')],
                        $queryParams
                    )
                ),
            default => $this->http()
                ->withUrlParameters($urlParams)
                ->$method(
                    $endpoint->getUrl(['api_key' => config('invoicexpress-for-laravel.account.api_key')]),
                    $bodyData
                ),
        };
    }

    /**
     * @throws RequestException
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
}
