<?php

namespace Squarebit\InvoiceXpress;

use Squarebit\InvoiceXpress\API\IXClientEndpoint;
use Squarebit\InvoiceXpress\API\IXCreditNoteEndpoint;
use Squarebit\InvoiceXpress\API\IXDebitNoteEndpoint;
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
    public const DATE_FORMAT = 'd/m/Y';

    public function clients(): IXClientEndpoint
    {
        return new IXClientEndpoint();
    }

    public function items(): IXItemEndpoint
    {
        return new IXItemEndpoint();
    }

    public function sequences(): IXSequenceEndpoint
    {
        return new IXSequenceEndpoint();
    }

    public function taxes(): IXTaxEndpoint
    {
        return new IXTaxEndpoint();
    }

    public function saft(): IXSaftEndpoint
    {
        return new IXSaftEndpoint();
    }

    public function invoices(): IXInvoiceEndpoint
    {
        return new IXInvoiceEndpoint();
    }

    public function guides(): IXGuideEndpoint
    {
        return new IXGuideEndpoint();
    }

    public function estimates(): IXEstimateEndpoint
    {
        return new IXEstimateEndpoint();
    }
}
