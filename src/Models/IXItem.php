<?php

namespace Squarebit\InvoiceXpress\Models;

/*
 * This is the InvoiceXpress Item.
 * https://invoicexpress.com/api-v2/items
 */

use Squarebit\InvoiceXpress\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\Traits\IXApiDelete;
use Squarebit\InvoiceXpress\Traits\IXApiGet;
use Squarebit\InvoiceXpress\Traits\IXApiList;
use Squarebit\InvoiceXpress\Traits\IXApiUpdate;

class IXItem extends IXEntity
{
    use IXApiList;
    use IXApiGet;
    use IXApiUpdate;
    use IXApiCreate;
    use IXApiDelete;

    protected static string $endpointConfig = 'item';
}
