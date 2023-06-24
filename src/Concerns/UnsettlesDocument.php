<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\Enums\DocumentEventEnum;

trait UnsettlesDocument
{
    use ChangesDocumentState;

    public function unsettleDocument(): static
    {
        return $this->changeStateTo(DocumentEventEnum::Unsettled);
    }
}
