<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\Enums\DocumentEventEnum;

trait ChangesDocumentState
{
    protected function changeStateTo(DocumentEventEnum $event): static
    {
        $data = $this->getEndpoint()->changeState(
            $this->entityType,
            $this->id,
            StateData::event($event)
        );

        $this->fromData($data)
            ->saveLocally();

        return $this;
    }
}
