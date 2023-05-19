<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\IXClient;

class Client extends APIModel
{
    protected ?string $apiResponseObject = 'client';

    public function getEndpoint(): IXClient
    {
        return new IXClient();
    }
}
