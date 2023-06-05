<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxCreditNote extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::CreditNote;
}
