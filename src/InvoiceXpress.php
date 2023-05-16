<?php

namespace Squarebit\InvoiceXpress;

use Squarebit\InvoiceXpress\Models\IXClient;
use Squarebit\InvoiceXpress\Models\IXItem;
use Squarebit\InvoiceXpress\Models\IXSequence;

class InvoiceXpress
{
    public function client(): IXClient
    {
        return new IXClient();
    }

    public function item(): IXItem
    {
        return new IXItem();
    }

    public function sequence(): IXSequence
    {
        return new IXSequence();
    }
}
