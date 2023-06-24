<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Concerns\UnsettlesDocument;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxDebitNote extends IxAbstractInvoice
{
    use UnsettlesDocument;

    protected EntityTypeEnum $entityType = EntityTypeEnum::DebitNote;
}
