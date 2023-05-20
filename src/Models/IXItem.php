<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\IXItemEndpoint;

class IXItem extends IXModel
{
    protected ?string $apiResponseObject = 'item';

    public function getEndpoint(): IXItemEndpoint
    {
        return new IXItemEndpoint();
    }
}
