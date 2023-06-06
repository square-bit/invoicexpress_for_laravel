<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxQuote extends IxAbstractEstimate
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Quote;
}
