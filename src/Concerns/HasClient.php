<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\Models\IxClient;

trait HasClient
{
    public function setClient(ClientData|IxClient|array $client): static
    {
        $this->client = match (true) {
            $client instanceof IxClient => $client->getData(),
            $client instanceof ClientData => $client,
            is_array($client) => ClientData::from($client),
        };

        return $this;
    }
}
