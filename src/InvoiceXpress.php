<?php

namespace Squarebit\InvoiceXpress;

use Squarebit\InvoiceXpress\Models\IXClient;
use Squarebit\InvoiceXpress\Models\IXInvoice;
use Squarebit\InvoiceXpress\Models\IXItem;
use Squarebit\InvoiceXpress\Models\IXSaft;
use Squarebit\InvoiceXpress\Models\IXSequence;
use Squarebit\InvoiceXpress\Models\IXTax;

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

    public function tax(): IXTax
    {
        return new IXTax();
    }

    public function saft(): IXSaft
    {
        return new IXSaft();
    }

    public function invoice(): IXInvoice
    {
        return new IXInvoice();
    }
}
