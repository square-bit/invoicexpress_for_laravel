<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxVatMossCreditNote extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::VatMossCreditNote;
}
