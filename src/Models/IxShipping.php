<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxShipping extends IxAbstractGuide
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Shipping;
}
