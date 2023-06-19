<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Enums\DocumentEventEnum;

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
