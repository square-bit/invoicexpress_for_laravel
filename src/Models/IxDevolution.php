<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxDevolution extends IxAbstractGuide
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Devolution;
}
