<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Concerns\UnsettlesDocument;

class IxCreditNote extends IxAbstractInvoice
{
    use UnsettlesDocument;

    protected EntityTypeEnum $entityType = EntityTypeEnum::CreditNote;
}
