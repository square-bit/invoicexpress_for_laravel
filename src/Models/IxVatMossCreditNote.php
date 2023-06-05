<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxVatMossCreditNote extends IxAbstractInvoice
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::VatMossCreditNote;
}
