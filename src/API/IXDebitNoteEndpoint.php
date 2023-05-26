<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

class IXDebitNoteEndpoint extends IXInvoiceEndpoint
{
    protected const JSON_ROOT_OBJECT_KEY = 'debit_note';

    protected function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::DebitNote;
    }
}
