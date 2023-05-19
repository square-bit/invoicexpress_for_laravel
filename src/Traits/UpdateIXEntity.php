<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait UpdateIXEntity
{
    public function save(): ?bool
    {
        try {
            $this->update(
                $this->id,
                [$this->apiResponseObject => $this->attributes]
            );

            return true;
        } catch (RequestException) {
        }

        return false;
    }
}
