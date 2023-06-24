<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxVatMossInvoice extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::VatMossInvoice;
}
