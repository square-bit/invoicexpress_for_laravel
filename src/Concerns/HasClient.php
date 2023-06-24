<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\Models\IxClient;

trait HasClient
{
    public function setClient(ClientData|IxClient|array $client): static
    {
        /** @var ClientData $data */
        $data = match (true) {
            $client instanceof IxClient => $client->getData(),
            $client instanceof ClientData => $client,
            is_array($client) => ClientData::from($client),
        };

        $this->client = $data;

        return $this;
    }
}
