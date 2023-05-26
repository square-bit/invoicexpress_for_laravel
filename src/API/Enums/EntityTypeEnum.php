<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Illuminate\Support\Str;

enum EntityTypeEnum: string
{
    case Client = 'client';
    case Item = 'item';
    case Tax = 'tax';
    case Invoice = 'invoice';
    case SimplifiedInvoice = 'simplified_invoice';
    case InvoiceReceipt = 'invoice_receipt';
    case VatMossInvoices = 'vat_moss_invoice';
    case CreditNote = 'credit_note';
    case DebitNote = 'debit_note';
    case Quote = 'quote';
    case Proforma = 'proforma';
    case FeesNote = 'fees_note';
    case Saft = 'saft';
    case Sequence = 'sequence';

    public function toUrlVariable(): string
    {
        return Str::plural($this->value);
    }
}
