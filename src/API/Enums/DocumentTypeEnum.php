<?php

namespace Squarebit\InvoiceXpress\API\Enums;

enum DocumentTypeEnum: string
{
    case Client = 'client';
    case Item = 'item';
    case Tax = 'tax';
    case Invoice = 'invoice';
    case SimplifiedInvoice = 'simplified_invoice';
    case InvoiceReceipt = 'invoice_receipt';
    case CreditNote = 'credit_note';
    case DebitNote = 'debit_note';
    case Quote = 'quote';
    case Proforma = 'proforma';
    case FeesNote = 'fees_note';
}
