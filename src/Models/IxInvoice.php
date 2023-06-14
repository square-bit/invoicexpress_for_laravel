<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Concerns\PaysDocument;

class IxInvoice extends IxAbstractInvoice
{
    use PaysDocument;

    protected EntityTypeEnum $entityType = EntityTypeEnum::Invoice;

    public function getEndpoint(): InvoicesEndpoint
    {
        return new InvoicesEndpoint();
    }
}
