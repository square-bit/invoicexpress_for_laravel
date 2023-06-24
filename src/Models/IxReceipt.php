<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxReceipt extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Receipt;
}
