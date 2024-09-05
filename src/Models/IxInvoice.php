<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\Concerns\PaysDocument;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxInvoice extends IxAbstractInvoice
{
    use PaysDocument;

    protected EntityTypeEnum $entityType = EntityTypeEnum::Invoice;

    public function getEndpoint(): InvoicesEndpoint
    {
        return new InvoicesEndpoint;
    }
}
