<?php

namespace Squarebit\InvoiceXpress\Facades;

use Illuminate\Support\Facades\Facade;
use Squarebit\InvoiceXpress\API\IXClientEndpoint;
use Squarebit\InvoiceXpress\API\IXCreditNoteEndpoint;
use Squarebit\InvoiceXpress\API\IXDebitNoteEndpoint;
use Squarebit\InvoiceXpress\API\IXEstimateEndpoint;
use Squarebit\InvoiceXpress\API\IXGuideEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceReceiptEndpoint;
use Squarebit\InvoiceXpress\API\IXItemEndpoint;
use Squarebit\InvoiceXpress\API\IXSaftEndpoint;
use Squarebit\InvoiceXpress\API\IXSimplifiedInvoiceEndpoint;
use Squarebit\InvoiceXpress\API\IXTaxEndpoint;

/**
 * @see \Squarebit\InvoiceXpress\InvoiceXpress
 *
 * @method static IXClientEndpoint client()
 * @method static IXItemEndpoint item()
 * @method static IXTaxEndpoint tax()
 * @method static IXSaftEndpoint saft()
 * @method static IXInvoiceEndpoint invoice()
 * @method static IXGuideEndpoint guide()
 * @method static IXEstimateEndpoint estimates()
 * @method static IXSimplifiedInvoiceEndpoint simplifiedInvoice()
 * @method static IXInvoiceReceiptEndpoint invoiceReceipt()
 * @method static IXCreditNoteEndpoint creditNote()
 * @method static IXDebitNoteEndpoint debitNote()
 */
class InvoiceXpress extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Squarebit\InvoiceXpress\InvoiceXpress::class;
    }
}
