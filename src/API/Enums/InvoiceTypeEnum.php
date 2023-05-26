<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Illuminate\Support\Str;
use Squarebit\InvoiceXpress\Concerns\EnumEnhancements;

enum InvoiceTypeEnum: string
{
    use EnumEnhancements;

    case Invoice = 'Invoice';
    case InvoiceReceipt = 'InvoiceReceipt';
    case SimplifiedInvoice = 'SimplifiedInvoice';
    case VatMossInvoice = 'VatMossInvoice';
    case CreditNote = 'CreditNote';
    case DebitNote = 'DebitNote';
    case Receipt = 'Receipt';
    case CashInvoice = 'CashInvoice';
    case VatMossReceipt = 'VatMossReceipt';
    case VatMossCreditNote = 'VatMossCreditNote';

    public function toEntityType(): ?EntityTypeEnum
    {
        return EntityTypeEnum::tryFrom(Str::snake($this->value));
    }
}
