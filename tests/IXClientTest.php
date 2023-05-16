<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;
use Squarebit\InvoiceXpress\Models\IXClient;

it('can call clients actions', function (string $action) {
    /** @var IXClient $client */
    $client = InvoiceXpress::client();
    $endpoint = $client->getEndpoint($action);

    Http::preventStrayRequests();
    Http::fake([
        UriTemplate::expand($endpoint->getUrl(), []) => Http::response('ok')
    ]);

    expect($client->exec($action))
        ->not()->toThrow(Exception::class);
})->with([
    IXClient::LIST,
    IXClient::GET,
    IXClient::CREATE,
    IXClient::UPDATE,
    IXClient::FIND_BY_NAME,
    IXClient::LIST_INVOICES,
]);;
