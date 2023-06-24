<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxInvoiceReceipt extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::InvoiceReceipt;
}
