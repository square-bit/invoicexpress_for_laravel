<?php

namespace Squarebit\InvoiceXpress\Enums;

enum InvoiceTypeEnum: string
{
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
