<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\Enums\DocumentEventEnum;

trait SettlesDocument
{
    use ChangesDocumentState;

    public function settleDocument(): static
    {
        return $this->changeStateTo(DocumentEventEnum::Settled);
    }
}
