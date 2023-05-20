<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Item.
 * https://invoicexpress.com/api-v2/items
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiCreate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiDelete;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdate;

class IXItemEndpoint extends IXEndpoint
{
    use IXApiList;
    use IXApiGet;
    use IXApiUpdate;
    use IXApiCreate;
    use IXApiDelete;

    protected static string $endpointConfig = 'item';
}
