<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxFeesNote extends IxQuote
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::FeesNote;
}
