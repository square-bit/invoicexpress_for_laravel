<?php

use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\Database\Factories\IxClientFactory;
use Squarebit\InvoiceXpress\Models\IxSimplifiedInvoice;

it('can set a client', function () {

    $invoice = new IxSimplifiedInvoice();
    $client = IxClientFactory::new()->make();

    expect($invoice->setClient($client))
        ->client->toBeInstanceOf(ClientData::class);
});

it('can get a client', function () {

    $invoice = new IxSimplifiedInvoice();
    $client = IxClientFactory::new()->make();
    $invoice->client = $client->getData();

    expect($invoice->client)
        ->toBeInstanceOf(ClientData::class);
});
