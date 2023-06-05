<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxCashInvoice extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::CashInvoice;
}
