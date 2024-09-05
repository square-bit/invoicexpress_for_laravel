<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Enums\Concerns\ConvertsToEntityTypeEnum;
use Squarebit\InvoiceXpress\Enums\Concerns\EnumEnhancements;

enum InvoiceTypeEnum: string
{
    use ConvertsToEntityTypeEnum;
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
}
