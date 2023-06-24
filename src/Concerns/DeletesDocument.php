<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\Enums\DocumentEventEnum;

trait DeletesDocument
{
    use ChangesDocumentState;

    public function deleteDocument(): static
    {
        return $this->changeStateTo(DocumentEventEnum::Deleted);
    }
}
