<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxReceipt extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Receipt;
}
