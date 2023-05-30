<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\API\Enums\Concerns\ConvertsToEntityTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\Concerns\EnumEnhancements;

enum InvoiceTypeEnum: string
{
    use EnumEnhancements;
    use ConvertsToEntityTypeEnum;

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
}
