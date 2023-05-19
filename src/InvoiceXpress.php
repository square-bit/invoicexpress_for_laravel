<?php

namespace Squarebit\InvoiceXpress;

use Squarebit\InvoiceXpress\API\IXClient;
use Squarebit\InvoiceXpress\API\IXEstimate;
use Squarebit\InvoiceXpress\API\IXGuide;
use Squarebit\InvoiceXpress\API\IXInvoice;
use Squarebit\InvoiceXpress\API\IXItem;
use Squarebit\InvoiceXpress\API\IXSaft;
use Squarebit\InvoiceXpress\API\IXSequence;
use Squarebit\InvoiceXpress\API\IXTax;

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

    public function guide(): IXGuide
    {
        return new IXGuide();
    }

    public function estimate(): IXEstimate
    {
        return new IXEstimate();
    }
}
