<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

class IXSimplifiedInvoiceEndpoint extends IXInvoiceEndpoint
{
    protected const JSON_ROOT_OBJECT_KEY = 'simplified_invoice';

    protected function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::SimplifiedInvoice;
    }
}
