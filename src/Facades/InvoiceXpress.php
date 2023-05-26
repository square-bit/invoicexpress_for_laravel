<?php

namespace Squarebit\InvoiceXpress\Facades;

use Illuminate\Support\Facades\Facade;
use Squarebit\InvoiceXpress\API\IXClientEndpoint;
use Squarebit\InvoiceXpress\API\IXEstimateEndpoint;
use Squarebit\InvoiceXpress\API\IXGuideEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceEndpoint;
use Squarebit\InvoiceXpress\API\IXItemEndpoint;
use Squarebit\InvoiceXpress\API\IXSaftEndpoint;
use Squarebit\InvoiceXpress\API\IXTaxEndpoint;

/**
 * @see \Squarebit\InvoiceXpress\InvoiceXpress
 *
 * @method static IXClientEndpoint clients()
 * @method static IXItemEndpoint items()
 * @method static IXTaxEndpoint taxes()
 * @method static IXSaftEndpoint saft()
 * @method static IXInvoiceEndpoint invoices()
 * @method static IXGuideEndpoint guides()
 * @method static IXEstimateEndpoint estimates()
 */
class InvoiceXpress extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Squarebit\InvoiceXpress\InvoiceXpress::class;
    }
}
