<?php

// config for Squarebit/InvoiceXpress

use Squarebit\InvoiceXpress\Models\IXClient;
use Squarebit\InvoiceXpress\Models\IXItem;
use Squarebit\InvoiceXpress\Models\IXSequence;

return [
    'account' => [
        'name' => env('IX_ACCOUNT_NAME'),
        'api_key' => env('IX_API_KEY'),
    ],
    'service_endpoint' => 'app.invoicexpress.com',
    'endpoints' => [
        // ######################################################
        // CLIENT
        // ######################################################
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
        // ######################################################
        // ITEM
        // ######################################################
        'item' => [
            IXItem::LIST => [
                'path' => 'items.json',
                'method' => 'GET',
            ],
            IXItem::GET => [
                'path' => 'items/{id}.json',
                'method' => 'GET',
            ],
            IXItem::UPDATE => [
                'path' => 'items/{id}.json',
                'method' => 'PUT',
            ],
            IXItem::CREATE => [
                'path' => 'items.json',
                'method' => 'POST',
            ],
            IXItem::DELETE => [
                'path' => 'items/{id}.json',
                'method' => 'DELETE',
            ],
        ],
        // ######################################################
        // SEQUENCE
        // ######################################################
        'sequence' => [
            IXSequence::LIST => [
                'path' => 'sequences.json',
                'method' => 'GET',
            ],
            IXSequence::GET => [
                'path' => 'sequences/{id}.json',
                'method' => 'GET',
            ],
            IXSequence::UPDATE => [
                'path' => 'sequences/{id}.json',
                'method' => 'PUT',
            ],
            IXSequence::CREATE => [
                'path' => 'sequences.json',
                'method' => 'POST',
            ],
            IXSequence::REGISTER => [
                'path' => 'sequences/{id}/register.json',
                'method' => 'PUT',
            ],
        ],
    ],
];
