<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxTransport extends IxShipping
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Transport;
}
