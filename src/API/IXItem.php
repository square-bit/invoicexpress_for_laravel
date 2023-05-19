<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Item.
 * https://invoicexpress.com/api-v2/items
 */

use Squarebit\InvoiceXpress\API\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\API\Traits\IXApiDelete;
use Squarebit\InvoiceXpress\API\Traits\IXApiGet;
use Squarebit\InvoiceXpress\API\Traits\IXApiList;
use Squarebit\InvoiceXpress\API\Traits\IXApiUpdate;

class IXItem extends IXEndpoint
{
    use IXApiList;
    use IXApiGet;
    use IXApiUpdate;
    use IXApiCreate;
    use IXApiDelete;

    protected static string $endpointConfig = 'item';
}
