<?php

namespace Squarebit\InvoiceXpress;

use Squarebit\InvoiceXpress\API\IXClientEndpoint;
use Squarebit\InvoiceXpress\API\IXEstimateEndpoint;
use Squarebit\InvoiceXpress\API\IXGuideEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceReceiptEndpoint;
use Squarebit\InvoiceXpress\API\IXItemEndpoint;
use Squarebit\InvoiceXpress\API\IXSaftEndpoint;
use Squarebit\InvoiceXpress\API\IXSequenceEndpoint;
use Squarebit\InvoiceXpress\API\IXSimplifiedInvoiceEndpoint;
use Squarebit\InvoiceXpress\API\IXTaxEndpoint;

class InvoiceXpress
{
    public function client(): IXClientEndpoint
    {
        return new IXClientEndpoint();
    }

    public function item(): IXItemEndpoint
    {
        return new IXItemEndpoint();
    }

    public function sequence(): IXSequenceEndpoint
    {
        return new IXSequenceEndpoint();
    }

    public function tax(): IXTaxEndpoint
    {
        return new IXTaxEndpoint();
    }

    public function saft(): IXSaftEndpoint
    {
        return new IXSaftEndpoint();
    }

    public function invoice(): IXInvoiceEndpoint
    {
        return new IXInvoiceEndpoint();
    }

    public function guide(): IXGuideEndpoint
    {
        return new IXGuideEndpoint();
    }

    public function estimate(): IXEstimateEndpoint
    {
        return new IXEstimateEndpoint();
    }

    public function simplifiedInvoice(): IXSimplifiedInvoiceEndpoint
    {
        return new IXSimplifiedInvoiceEndpoint();
    }

    public function invoiceReceipt(): IXInvoiceReceiptEndpoint
    {
        return new IXInvoiceReceiptEndpoint();
    }
}
