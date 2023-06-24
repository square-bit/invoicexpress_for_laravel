<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\Concerns\UnsettlesDocument;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

class IxCreditNote extends IxAbstractInvoice
{
    use UnsettlesDocument;

    protected EntityTypeEnum $entityType = EntityTypeEnum::CreditNote;
}
