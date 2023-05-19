<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Client.
 * https://invoicexpress.com/api-v2/clients
 */

use Squarebit\InvoiceXpress\API\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\API\Traits\IXApiFindByCode;
use Squarebit\InvoiceXpress\API\Traits\IXApiFindByName;
use Squarebit\InvoiceXpress\API\Traits\IXApiGet;
use Squarebit\InvoiceXpress\API\Traits\IXApiList;
use Squarebit\InvoiceXpress\API\Traits\IXApiListInvoices;
use Squarebit\InvoiceXpress\API\Traits\IXApiUpdate;

class IXClient extends IXEndpoint
{
    use IXApiList;
    use IXApiGet;
    use IXApiCreate;
    use IXApiUpdate;
    use IXApiFindByCode;
    use IXApiFindByName;
    use IXApiListInvoices;

    protected static string $endpointConfig = 'client';
}
