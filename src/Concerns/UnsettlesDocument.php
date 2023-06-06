<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\API\Enums\DocumentEventEnum;

trait UnsettlesDocument
{
    use ChangesDocumentState;

    public function unsettleDocument(): static
    {
        return $this->changeStateTo(DocumentEventEnum::Unsettled);
    }
}
