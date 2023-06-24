<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxShipping extends IxAbstractGuide
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Shipping;
}
