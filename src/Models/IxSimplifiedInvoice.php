<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Concerns\PaysDocument;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxSimplifiedInvoice extends IxAbstractInvoice
{
    use PaysDocument;

    protected EntityTypeEnum $entityType = EntityTypeEnum::SimplifiedInvoice;
}
