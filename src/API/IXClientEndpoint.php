<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Client.
 * https://invoicexpress.com/api-v2/clients
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiCreate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiFindByCode;
use Squarebit\InvoiceXpress\API\Concerns\IXApiFindByName;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiListInvoices;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdate;

class IXClientEndpoint extends IXEndpoint
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
