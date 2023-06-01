<?php

// config for Squarebit/InvoiceXpress

use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SaftEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SequencesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\TaxesEndpoint;

return [
    // ######################################################
    // CLIENT
    // ######################################################
    'client' => [
        ClientsEndpoint::LIST => [
            'path' => 'clients.json',
            'method' => 'GET',
        ],
        ClientsEndpoint::GET => [
            'path' => 'clients/{id}.json',
            'method' => 'GET',
        ],
        ClientsEndpoint::UPDATE => [
            'path' => 'clients/{id}.json',
            'method' => 'PUT',
        ],
        ClientsEndpoint::CREATE => [
            'path' => 'clients.json',
            'method' => 'POST',
        ],
        ClientsEndpoint::FIND_BY_NAME => [
            'path' => 'clients/find-by-name.json',
            'method' => 'GET',
        ],
        ClientsEndpoint::FIND_BY_CODE => [
            'path' => 'clients/find-by-code.json',
            'method' => 'GET',
        ],
        ClientsEndpoint::LIST_INVOICES => [
            'path' => 'clients/{id}/invoices.json',
            'method' => 'POST',
        ],
        ClientsEndpoint::DELETE => [
            'path' => 'clients/{id}.json',
            'method' => 'DELETE',
        ],
    ],
    // ######################################################
    // ITEM
    // ######################################################
    'item' => [
        ItemsEndpoint::LIST => [
            'path' => 'items.json',
            'method' => 'GET',
        ],
        ItemsEndpoint::GET => [
            'path' => 'items/{id}.json',
            'method' => 'GET',
        ],
        ItemsEndpoint::UPDATE => [
            'path' => 'items/{id}.json',
            'method' => 'PUT',
        ],
        ItemsEndpoint::CREATE => [
            'path' => 'items.json',
            'method' => 'POST',
        ],
        ItemsEndpoint::DELETE => [
            'path' => 'items/{id}.json',
            'method' => 'DELETE',
        ],
    ],
    // ######################################################
    // SEQUENCE
    // ######################################################
    'sequence' => [
        SequencesEndpoint::LIST => [
            'path' => 'sequences.json',
            'method' => 'GET',
        ],
        SequencesEndpoint::GET => [
            'path' => 'sequences/{id}.json',
            'method' => 'GET',
        ],
        SequencesEndpoint::SET_CURRENT => [
            'path' => 'sequences/{id}/set_current.json',
            'method' => 'PUT',
        ],
        SequencesEndpoint::CREATE => [
            'path' => 'sequences.json',
            'method' => 'POST',
        ],
        SequencesEndpoint::REGISTER => [
            'path' => 'sequences/{id}/register.json',
            'method' => 'PUT',
        ],
    ],
    // ######################################################
    // TAX
    // ######################################################
    'tax' => [
        TaxesEndpoint::LIST => [
            'path' => 'taxes.json',
            'method' => 'GET',
        ],
        TaxesEndpoint::GET => [
            'path' => 'taxes/{id}.json',
            'method' => 'GET',
        ],
        TaxesEndpoint::UPDATE => [
            'path' => 'taxes/{id}.json',
            'method' => 'PUT',
        ],
        TaxesEndpoint::CREATE => [
            'path' => 'taxes.json',
            'method' => 'POST',
        ],
        TaxesEndpoint::DELETE => [
            'path' => 'taxes/{id}.json',
            'method' => 'DELETE',
        ],
    ],
    // ######################################################
    // SAFT
    // ######################################################
    'saft' => [
        SaftEndpoint::EXPORT_SAFT => [
            'path' => 'api/export_saft.json',
            'method' => 'GET',
        ],
    ],
    // ######################################################
    // INVOICE
    // ######################################################
    'invoice' => [
        InvoicesEndpoint::GET => [
            'path' => '{type}/{id}.json',
            'method' => 'GET',
        ],
        InvoicesEndpoint::LIST => [
            'path' => 'invoices.json',
            'method' => 'GET',
        ],
        InvoicesEndpoint::CREATE => [
            'path' => '{type}.json',
            'method' => 'POST',
        ],
        InvoicesEndpoint::UPDATE => [
            'path' => '{type}/{id}.json',
            'method' => 'PUT',
        ],
        InvoicesEndpoint::CHANGE_STATE => [
            'path' => '{type}/{id}/change-state.json',
            'method' => 'PUT',
        ],
        InvoicesEndpoint::RELATED_DOCUMENTS => [
            'path' => 'document/{id}/related_documents.json',
            'method' => 'GET',
        ],
        InvoicesEndpoint::GENERATE_PAYMENT => [
            'path' => 'documents/{id}/partial_payments.json',
            'method' => 'POST',
        ],
        InvoicesEndpoint::CANCEL_PAYMENT => [
            'path' => 'receipts/{id}/change-state.json',
            'method' => 'PUT',
        ],
        InvoicesEndpoint::GET_QRCODE => [
            'path' => 'api/qr_codes/{id}.json',
            'method' => 'GET',
        ],
        InvoicesEndpoint::SEND_BY_EMAIL => [
            'path' => '{type}/{id}/email-document.json',
            'method' => 'PUT',
        ],
        InvoicesEndpoint::GENERATE_PDF => [
            'path' => 'api/pdf/{id}.json',
            'method' => 'GET',
        ],
    ],
    // ######################################################
    // ESTIMATE
    // ######################################################
    'estimate' => [
        EstimatesEndpoint::GET => [
            'path' => '{type}/{id}.json',
            'method' => 'GET',
        ],
        EstimatesEndpoint::LIST => [
            'path' => 'estimates.json',
            'method' => 'GET',
        ],
        EstimatesEndpoint::CREATE => [
            'path' => '{type}.json',
            'method' => 'POST',
        ],
        EstimatesEndpoint::UPDATE => [
            'path' => '{type}/{id}.json',
            'method' => 'PUT',
        ],
        EstimatesEndpoint::CHANGE_STATE => [
            'path' => '{type}/{id}/change-state.json',
            'method' => 'PUT',
        ],
        EstimatesEndpoint::SEND_BY_EMAIL => [
            'path' => '{type}/{id}/email-document.json',
            'method' => 'PUT',
        ],
        EstimatesEndpoint::GENERATE_PDF => [
            'path' => 'api/pdf/{id}.json',
            'method' => 'GET',
        ],
    ],
    // ######################################################
    // GUIDE
    // ######################################################
    'guide' => [
        GuidesEndpoint::GET => [
            'path' => '{type}/{id}.json',
            'method' => 'GET',
        ],
        GuidesEndpoint::LIST => [
            'path' => 'guides.json',
            'method' => 'GET',
        ],
        GuidesEndpoint::CREATE => [
            'path' => '{type}.json',
            'method' => 'POST',
        ],
        GuidesEndpoint::UPDATE => [
            'path' => '{type}/{id}.json',
            'method' => 'PUT',
        ],
        GuidesEndpoint::CHANGE_STATE => [
            'path' => '{type}/{id}/change-state.json',
            'method' => 'PUT',
        ],
        GuidesEndpoint::SEND_BY_EMAIL => [
            'path' => '{type}/{id}/email-document.json',
            'method' => 'PUT',
        ],
        GuidesEndpoint::GENERATE_PDF => [
            'path' => 'api/pdf/{id}.json',
            'method' => 'GET',
        ],
        GuidesEndpoint::GET_QRCODE => [
            'path' => 'api/qr_codes/{id}.json',
            'method' => 'GET',
        ],
    ],
];
