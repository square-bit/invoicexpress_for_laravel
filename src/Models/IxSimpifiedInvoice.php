<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Concerns\PaysDocument;

class IxSimpifiedInvoice extends IxAbstractInvoice
{
    use PaysDocument;

    protected EntityTypeEnum $entityType = EntityTypeEnum::SimplifiedInvoice;
}
