<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\IXItem;

class Item extends IXModel
{
    protected ?string $apiResponseObject = 'item';

    public function getEndpoint(): IXItem
    {
        return new IXItem();
    }
}
