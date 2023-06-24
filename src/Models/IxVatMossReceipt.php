<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxVatMossReceipt extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::VatMossReceipt;
}
