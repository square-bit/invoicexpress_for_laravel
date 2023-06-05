<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxInvoiceReceipt extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::InvoiceReceipt;
}
