<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxQuote extends IxAbstractEstimate
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Quote;
}
