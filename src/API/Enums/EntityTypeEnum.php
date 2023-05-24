<?php

namespace Squarebit\InvoiceXpress\API\Enums;

enum EntityTypeEnum: string
{
    case Clients = 'clients';
    case Items = 'items';
    case Taxes = 'taxes';
    case Invoices = 'invoices';
    case SimplifiedInvoices = 'simplified_invoices';
    case InvoiceReceipts = 'invoice_receipts';
    case CreditNotes = 'credit_notes';
    case DebitNotes = 'debit_notes';
    case Quotes = 'quotes';
    case Proformas = 'proformas';
    case FeesNotes = 'fees_notes';
}
