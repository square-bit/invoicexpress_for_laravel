<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\IXClientEndpoint;
use Squarebit\InvoiceXpress\Concerns\FindIXModel;
use Squarebit\InvoiceXpress\Concerns\ListIXModel;
use Squarebit\InvoiceXpress\Concerns\UpdateIXModel;

class IXClient extends IXModel
{
    use FindIXModel;
    use UpdateIXModel;
    use ListIXModel;

    public function getEndpoint(): IXClientEndpoint
    {
        return new IXClientEndpoint();
    }
}
