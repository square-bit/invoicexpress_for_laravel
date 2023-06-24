<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxFeesNote extends IxQuote
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::FeesNote;
}
