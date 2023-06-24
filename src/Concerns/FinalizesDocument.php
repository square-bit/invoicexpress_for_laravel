<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\Enums\DocumentEventEnum;

trait FinalizesDocument
{
    use ChangesDocumentState;

    public function finalizeDocument(): static
    {
        $this->changeStateTo(DocumentEventEnum::Finalized);

        return $this;
    }
}
