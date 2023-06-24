<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\Enums\DocumentEventEnum;

trait RefusesDocument
{
    use ChangesDocumentState;

    public function refuseDocument(): static
    {
        return $this->changeStateTo(DocumentEventEnum::Refuse);
    }
}
