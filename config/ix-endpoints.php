<?php

// config for Squarebit/InvoiceXpress

use Squarebit\InvoiceXpress\API\IXClientEndpoint;
use Squarebit\InvoiceXpress\API\IXEstimateEndpoint;
use Squarebit\InvoiceXpress\API\IXGuideEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceEndpoint;
use Squarebit\InvoiceXpress\API\IXItemEndpoint;
use Squarebit\InvoiceXpress\API\IXSaftEndpoint;
use Squarebit\InvoiceXpress\API\IXSequenceEndpoint;
use Squarebit\InvoiceXpress\API\IXTaxEndpoint;

return [
    // ######################################################
    // CLIENT
    // ######################################################
    'client' => [
        IXClientEndpoint::LIST => [
            'path' => 'clients.json',
            'method' => 'GET',
            'returns' => [200],
            'throws' => [401],
        ],
        IXClientEndpoint::GET => [
            'path' => 'clients/{id}.json',
            'method' => 'GET',
            'returns' => [200],
            'throws' => [401, 404],
        ],
        IXClientEndpoint::UPDATE => [
            'path' => 'clients/{id}.json',
            'method' => 'PUT',
            'returns' => [200],
            'throws' => [401, 404, 422],
        ],
        IXClientEndpoint::CREATE => [
            'path' => 'clients.json',
            'method' => 'POST',
            'returns' => [200],
            'throws' => [401, 422],
        ],
        IXClientEndpoint::FIND_BY_NAME => [
            'path' => 'clients/find-by-name.json',
            'method' => 'GET',
            'returns' => [200],
            'throws' => [401, 404],
        ],
        IXClientEndpoint::FIND_BY_CODE => [
            'path' => 'clients/find-by-code.json',
            'method' => 'GET',
            'returns' => [200],
            'throws' => [401, 404],
        ],
        IXClientEndpoint::LIST_INVOICES => [
            'path' => 'clients/{id}/invoices.json',
            'method' => 'POST',
            'returns' => [200],
            'throws' => [401, 404],
        ],
        IXClientEndpoint::DELETE => [
            'path' => 'clients/{id}.json',
            'method' => 'DELETE',
        ],
    ],
    // ######################################################
    // ITEM
    // ######################################################
    'item' => [
        IXItemEndpoint::LIST => [
            'path' => 'items.json',
            'method' => 'GET',
        ],
        IXItemEndpoint::GET => [
            'path' => 'items/{id}.json',
            'method' => 'GET',
        ],
        IXItemEndpoint::UPDATE => [
            'path' => 'items/{id}.json',
            'method' => 'PUT',
        ],
        IXItemEndpoint::CREATE => [
            'path' => 'items.json',
            'method' => 'POST',
        ],
        IXItemEndpoint::DELETE => [
            'path' => 'items/{id}.json',
            'method' => 'DELETE',
        ],
    ],
    // ######################################################
    // SEQUENCE
    // ######################################################
    'sequence' => [
        IXSequenceEndpoint::LIST => [
            'path' => 'sequences.json',
            'method' => 'GET',
        ],
        IXSequenceEndpoint::GET => [
            'path' => 'sequences/{id}.json',
            'method' => 'GET',
        ],
        IXSequenceEndpoint::UPDATE => [
            'path' => 'sequences/{id}/set_current.json',
            'method' => 'PUT',
        ],
        IXSequenceEndpoint::CREATE => [
            'path' => 'sequences.json',
            'method' => 'POST',
        ],
        IXSequenceEndpoint::REGISTER => [
            'path' => 'sequences/{id}/register.json',
            'method' => 'PUT',
        ],
    ],
    // ######################################################
    // TAX
    // ######################################################
    'tax' => [
        IXTaxEndpoint::LIST => [
            'path' => 'taxes.json',
            'method' => 'GET',
        ],
        IXTaxEndpoint::GET => [
            'path' => 'taxes/{id}.json',
            'method' => 'GET',
        ],
        IXTaxEndpoint::UPDATE => [
            'path' => 'taxes/{id}.json',
            'method' => 'PUT',
        ],
        IXTaxEndpoint::CREATE => [
            'path' => 'taxes.json',
            'method' => 'POST',
        ],
        IXTaxEndpoint::DELETE => [
            'path' => 'taxes/{id}.json',
            'method' => 'DELETE',
        ],
    ],
    // ######################################################
    // SAFT
    // ######################################################
    'saft' => [
        IXSaftEndpoint::GET => [
            'path' => 'api/export_saft.json',
            'method' => 'GET',
        ],
    ],
    // ######################################################
    // INVOICE
    // ######################################################
    'invoice' => [
        IXInvoiceEndpoint::GET => [
            'path' => '{type}/{id}.json',
            'method' => 'GET',
        ],
        IXInvoiceEndpoint::LIST => [
            'path' => 'invoices.json',
            'method' => 'GET',
        ],
        IXInvoiceEndpoint::CREATE => [
            'path' => '{type}.json',
            'method' => 'POST',
        ],
        IXInvoiceEndpoint::UPDATE => [
            'path' => '{type}/{id}.json',
            'method' => 'PUT',
        ],
        IXInvoiceEndpoint::CHANGE_STATE => [
            'path' => '{type}/{id}/change-state.json',
            'method' => 'PUT',
        ],
        IXInvoiceEndpoint::RELATED_DOCUMENTS => [
            'path' => 'document/{id}/related_documents.json',
            'method' => 'GET',
        ],
        IXInvoiceEndpoint::GENERATE_PAYMENT => [
            'path' => 'documents/{id}/partial_payments.json',
            'method' => 'POST',
        ],
        IXInvoiceEndpoint::CANCEL_PAYMENT => [
            'path' => '/receipts/{id}/change-state.json',
            'method' => 'PUT',
        ],
        IXInvoiceEndpoint::GET_QRCODE => [
            'path' => '/api/qr_codes/{id}.json',
            'method' => 'GET',
        ],
        IXInvoiceEndpoint::SEND_BY_EMAIL => [
            'path' => '{type}/{id}/email-document.json',
            'method' => 'PUT',
        ],
        IXInvoiceEndpoint::GENERATE_PDF => [
            'path' => '/api/pdf/{id}.json',
            'method' => 'GET',
        ],
    ],
    // ######################################################
    // ESTIMATE
    // ######################################################
    'estimate' => [
        IXEstimateEndpoint::GET => [
            'path' => '{type}/{id}.json',
            'method' => 'GET',
        ],
        IXEstimateEndpoint::LIST => [
            'path' => 'estimates.json',
            'method' => 'GET',
        ],
        IXEstimateEndpoint::CREATE => [
            'path' => '{type}.json',
            'method' => 'POST',
        ],
        IXEstimateEndpoint::UPDATE => [
            'path' => '{type}/{id}.json',
            'method' => 'PUT',
        ],
        IXEstimateEndpoint::CHANGE_STATE => [
            'path' => '{type}/{id}/change-state.json',
            'method' => 'PUT',
        ],
        IXEstimateEndpoint::SEND_BY_EMAIL => [
            'path' => '{type}/{id}/email-document.json',
            'method' => 'PUT',
        ],
        IXEstimateEndpoint::GENERATE_PDF => [
            'path' => '/api/pdf/{id}.json',
            'method' => 'GET',
        ],
    ],
    // ######################################################
    // GUIDE
    // ######################################################
    'guide' => [
        IXGuideEndpoint::GET => [
            'path' => '{type}/{id}.json',
            'method' => 'GET',
        ],
        IXGuideEndpoint::LIST => [
            'path' => 'guides.json',
            'method' => 'GET',
        ],
        IXGuideEndpoint::CREATE => [
            'path' => '{type}.json',
            'method' => 'POST',
        ],
        IXGuideEndpoint::UPDATE => [
            'path' => '{type}/{id}.json',
            'method' => 'PUT',
        ],
        IXGuideEndpoint::CHANGE_STATE => [
            'path' => '{type}/{id}/change-state.json',
            'method' => 'PUT',
        ],
        IXGuideEndpoint::SEND_BY_EMAIL => [
            'path' => '{type}/{id}/email-document.json',
            'method' => 'PUT',
        ],
        IXGuideEndpoint::GENERATE_PDF => [
            'path' => '/api/pdf/{id}.json',
            'method' => 'GET',
        ],
        IXGuideEndpoint::GET_QRCODE => [
            'path' => '/api/qr_codes/{id}.json',
            'method' => 'GET',
        ],
    ],
];
