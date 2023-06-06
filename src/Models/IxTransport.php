<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxTransport extends IxAbstractGuide
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Transport;
}
