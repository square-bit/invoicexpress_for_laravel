<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\Enums\DocumentEventEnum;

trait CancelsDocument
{
    use ChangesDocumentState;

    public function cancelDocument(): static
    {
        return $this->changeStateTo(DocumentEventEnum::Canceled);
    }
}
