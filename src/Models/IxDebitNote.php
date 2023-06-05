<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxDebitNote extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::DebitNote;
}
