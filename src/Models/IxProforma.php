<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxProforma extends IxQuote
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Proforma;
}
