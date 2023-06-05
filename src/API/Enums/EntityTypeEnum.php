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
    case VatMossInvoice = 'vat_moss_invoice';
    case VatMossCreditNote = 'vat_moss_credit_note';
    case VatMossReceipt = 'vat_moss_receipt';
    case CreditNote = 'credit_note';
    case DebitNote = 'debit_note';
    case Receipt = 'receipt';
    case CashInvoice = 'cash_invoice';
    case Quote = 'quote';
    case Proforma = 'proforma';
    case FeesNote = 'fees_note';
    case Saft = 'saft';
    case Sequence = 'sequence';
    case Shipping = 'shipping';
    case Transport = 'transport';
    case Devolution = 'devolution';

    public function toUrlVariable(): string
    {
        return Str::plural($this->value);
    }
}
