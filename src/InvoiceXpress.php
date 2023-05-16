<?php

namespace Squarebit\InvoiceXpress;

use Squarebit\InvoiceXpress\Models\IXClient;

class InvoiceXpress
{
    public function client(): IXClient
    {
        return new IXClient();
    }
}
