<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\IXClient;
use Squarebit\InvoiceXpress\Traits\FindIXModel;
use Squarebit\InvoiceXpress\Traits\ListIXModel;
use Squarebit\InvoiceXpress\Traits\UpdateIXModel;

class Client extends IXModel
{
    use FindIXModel;
    use UpdateIXModel;
    use ListIXModel;

    public function getEndpoint(): IXClient
    {
        return new IXClient();
    }
}
