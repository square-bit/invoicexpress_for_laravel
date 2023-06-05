<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxVatMossInvoice extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::VatMossInvoice;
}
