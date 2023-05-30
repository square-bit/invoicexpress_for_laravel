<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Endpoints\TaxesEndpoint;

class IxTax extends IxModel
{
    protected string $dataClass = TaxData::class;

    protected function getEndpoint(): TaxesEndpoint
    {
        return new TaxesEndpoint();
    }
}
