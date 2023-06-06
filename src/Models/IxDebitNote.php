<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Concerns\UnsettlesDocument;

class IxDebitNote extends IxAbstractInvoice
{
    use UnsettlesDocument;

    protected EntityTypeEnum $entityType = EntityTypeEnum::DebitNote;
}
