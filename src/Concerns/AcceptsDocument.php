<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\Enums\DocumentEventEnum;

trait AcceptsDocument
{
    use ChangesDocumentState;

    public function acceptDocument(): static
    {
        return $this->changeStateTo(DocumentEventEnum::Accept);
    }
}
