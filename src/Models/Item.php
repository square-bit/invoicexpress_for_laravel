<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\IXItem;

class Item extends APIModel
{
    protected ?string $apiResponseObject = 'item';

    public function getEndpoint(): IXItem
    {
        return new IXItem();
    }
}
