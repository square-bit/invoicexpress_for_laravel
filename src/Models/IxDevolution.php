<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxDevolution extends IxShipping
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Devolution;
}
