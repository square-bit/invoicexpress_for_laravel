<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

class IXInvoiceReceiptEndpoint extends IXInvoiceEndpoint
{
    protected const JSON_ROOT_OBJECT_KEY = 'invoice_receipt';

    protected function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::InvoiceReceipt;
    }
}
