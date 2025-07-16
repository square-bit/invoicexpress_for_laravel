<?php

/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums;

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

    public function toStudlyCase(): string
    {
        return Str::studly($this->value);
    }

    public function toDataKey(): string
    {
        return match ($this) {
            self::Invoice, self::SimplifiedInvoice, self::InvoiceReceipt, self::VatMossInvoice, self::VatMossCreditNote, self::VatMossReceipt, self::CreditNote, self::DebitNote, self::Receipt, self::CashInvoice => self::Invoice->value,
            self::Quote, self::Proforma, self::FeesNote => self::Quote->value,
            self::Shipping, self::Transport, self::Devolution => self::Shipping->value,
            default => $this->value,
        };
    }
}
