<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Illuminate\Http\Client\RequestException;

trait UpdateIXModel
{
    public function update(): ?bool
    {
        try {
            $this->getEndpoint()->update(
                $this->id,
                [$this->dataRootObjectName => $this->attributes]
            );

            return true;
        } catch (RequestException) {
        }

        return false;
    }
}