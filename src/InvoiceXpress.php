<?php

namespace Squarebit\InvoiceXpress;

use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SaftEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SequencesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\TaxesEndpoint;

class InvoiceXpress
{
    public const DATE_FORMAT = 'd/m/Y';

    public function clients(): ClientsEndpoint
    {
        return new ClientsEndpoint();
    }

    public function items(): ItemsEndpoint
    {
        return new ItemsEndpoint();
    }

    public function sequences(): SequencesEndpoint
    {
        return new SequencesEndpoint();
    }

    public function taxes(): TaxesEndpoint
    {
        return new TaxesEndpoint();
    }

    public function saft(): SaftEndpoint
    {
        return new SaftEndpoint();
    }

    public function invoices(): InvoicesEndpoint
    {
        return new InvoicesEndpoint();
    }

    public function guides(): GuidesEndpoint
    {
        return new GuidesEndpoint();
    }

    public function estimates(): EstimatesEndpoint
    {
        return new EstimatesEndpoint();
    }
}
