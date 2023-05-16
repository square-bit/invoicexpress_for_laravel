<?php

namespace Squarebit\InvoiceXpress\Models;

/*
 * This is the InvoiceXpress Saft.
 * https://invoicexpress.com/api-v2/saf-t
 */

use Squarebit\InvoiceXpress\Traits\IXApiGet;

class IXSaft extends IXEntity
{
    use IXApiGet;

    protected static string $endpointConfig = 'saft';
}
