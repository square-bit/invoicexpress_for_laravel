<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait UpdateIXModel
{
    public function save(): ?bool
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
