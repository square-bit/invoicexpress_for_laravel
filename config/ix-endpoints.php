<?php

// config for Squarebit/InvoiceXpress

use Squarebit\InvoiceXpress\Models\IXClient;
use Squarebit\InvoiceXpress\Models\IXEstimate;
use Squarebit\InvoiceXpress\Models\IXGuide;
use Squarebit\InvoiceXpress\Models\IXInvoice;
use Squarebit\InvoiceXpress\Models\IXItem;
use Squarebit\InvoiceXpress\Models\IXSaft;
use Squarebit\InvoiceXpress\Models\IXSequence;
use Squarebit\InvoiceXpress\Models\IXTax;

return [
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
            'path' => 'sequences/{id}/set_current.json',
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
    // ######################################################
    // TAX
    // ######################################################
    'tax' => [
        IXTax::LIST => [
            'path' => 'taxes.json',
            'method' => 'GET',
        ],
        IXTax::GET => [
            'path' => 'taxes/{id}.json',
            'method' => 'GET',
        ],
        IXTax::UPDATE => [
            'path' => 'taxes/{id}.json',
            'method' => 'PUT',
        ],
        IXTax::CREATE => [
            'path' => 'taxes.json',
            'method' => 'POST',
        ],
        IXTax::DELETE => [
            'path' => 'taxes/{id}.json',
            'method' => 'DELETE',
        ],
    ],
    // ######################################################
    // SAFT
    // ######################################################
    'saft' => [
        IXSaft::GET => [
            'path' => 'api/export_saft.json',
            'method' => 'GET',
        ],
    ],
    // ######################################################
    // INVOICE
    // ######################################################
    'invoice' => [
        IXInvoice::GET => [
            'path' => '{type}/{id}.json',
            'method' => 'GET',
        ],
        IXInvoice::LIST => [
            'path' => 'invoices.json',
            'method' => 'GET',
        ],
        IXInvoice::CREATE => [
            'path' => '{type}.json',
            'method' => 'POST',
        ],
        IXInvoice::UPDATE => [
            'path' => '{type}/{id}.json',
            'method' => 'PUT',
        ],
        IXInvoice::CHANGE_STATE => [
            'path' => '{type}/{id}/change-state.json',
            'method' => 'PUT',
        ],
        IXInvoice::RELATED_DOCUMENTS => [
            'path' => 'document/{id}/related_documents.json',
            'method' => 'GET',
        ],
        IXInvoice::GENERATE_PAYMENT => [
            'path' => 'document/{id}/partial_payments.json',
            'method' => 'POST',
        ],
        IXInvoice::CANCEL_PAYMENT => [
            'path' => '/receipts/{id}/change-state.json',
            'method' => 'PUT',
        ],
        IXInvoice::GET_QRCODE => [
            'path' => '/api/qr_codes/{id}.json',
            'method' => 'GET',
        ],
        IXInvoice::SEND_BY_EMAIL => [
            'path' => '{type}/{id}/email-document.json',
            'method' => 'PUT',
        ],
        IXInvoice::GENERATE_PDF => [
            'path' => '/api/pdf/{id}.json',
            'method' => 'GET',
        ],
    ],
    // ######################################################
    // ESTIMATE
    // ######################################################
    'estimate' => [
        IXEstimate::GET => [
            'path' => '{type}/{id}.json',
            'method' => 'GET',
        ],
        IXEstimate::LIST => [
            'path' => 'estimates.json',
            'method' => 'GET',
        ],
        IXEstimate::CREATE => [
            'path' => '{type}.json',
            'method' => 'POST',
        ],
        IXEstimate::UPDATE => [
            'path' => '{type}/{id}.json',
            'method' => 'PUT',
        ],
        IXEstimate::CHANGE_STATE => [
            'path' => '{type}/{id}/change-state.json',
            'method' => 'PUT',
        ],
        IXEstimate::SEND_BY_EMAIL => [
            'path' => '{type}/{id}/email-document.json',
            'method' => 'PUT',
        ],
        IXEstimate::GENERATE_PDF => [
            'path' => '/api/pdf/{id}.json',
            'method' => 'GET',
        ],
    ],
    // ######################################################
    // GUIDE
    // ######################################################
    'guide' => [
        IXGuide::GET => [
            'path' => '{type}/{id}.json',
            'method' => 'GET',
        ],
        IXGuide::LIST => [
            'path' => 'guides.json',
            'method' => 'GET',
        ],
        IXGuide::CREATE => [
            'path' => '{type}.json',
            'method' => 'POST',
        ],
        IXGuide::UPDATE => [
            'path' => '{type}/{id}.json',
            'method' => 'PUT',
        ],
        IXGuide::CHANGE_STATE => [
            'path' => '{type}/{id}/change-state.json',
            'method' => 'PUT',
        ],
        IXGuide::SEND_BY_EMAIL => [
            'path' => '{type}/{id}/email-document.json',
            'method' => 'PUT',
        ],
        IXGuide::GENERATE_PDF => [
            'path' => '/api/pdf/{id}.json',
            'method' => 'GET',
        ],
        IXGuide::GET_QRCODE => [
            'path' => '/api/qr_codes/{id}.json',
            'method' => 'GET',
        ],
    ],
];
