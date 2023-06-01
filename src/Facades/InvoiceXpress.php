<?php

namespace Squarebit\InvoiceXpress\Facades;

use Illuminate\Support\Facades\Facade;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SaftEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SequencesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\TaxesEndpoint;

/**
 * @see \Squarebit\InvoiceXpress\InvoiceXpress
 *
 * @method static ClientsEndpoint clients()
 * @method static ItemsEndpoint items()
 * @method static TaxesEndpoint taxes()
 * @method static SaftEndpoint saft()
 * @method static InvoicesEndpoint invoices()
 * @method static GuidesEndpoint guides()
 * @method static EstimatesEndpoint estimates()
 * @method static SequencesEndpoint sequences()
 */
class InvoiceXpress extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Squarebit\InvoiceXpress\InvoiceXpress::class;
    }
}
