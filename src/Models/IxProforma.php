<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxProforma extends IxQuote
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Proforma;
}
