<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

class IXCreditNoteEndpoint extends IXInvoiceEndpoint
{
    protected const JSON_ROOT_OBJECT_KEY = 'credit_note';

    protected function getEntityType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::CreditNotes;
    }
}
