<?php

// config for Squarebit/InvoiceXpress

use Squarebit\InvoiceXpress\Models\IXClient;

return [
    'account' => [
        'name' => env('IX_ACCOUNT_NAME'),
        'api_key' => env('IX_API_KEY'),
    ],
    'service_endpoint' => 'app.invoicexpress.com',
    'endpoints' => [
        'client' => [
            IXClient::LIST => [
                'path' => 'clients.json',
                'method' => 'GET',
            ],
            IXClient::GET => [
                'path' => 'clients/{id}.json',
                'method' => 'GET',
            ],
            IXClient::UPDATE => [
                'path' => 'clients/{id}.json',
                'method' => 'PUT',
            ],
            IXClient::CREATE => [
                'path' => 'clients.json',
                'method' => 'POST',
            ],
            IXClient::FIND_BY_NAME => [
                'path' => 'clients/find-by-name.json',
                'method' => 'GET',
            ],
            IXClient::LIST_INVOICES => [
                'path' => 'clients/{id}/invoices.json',
                'method' => 'POST',
            ],
        ],
    ],
];
