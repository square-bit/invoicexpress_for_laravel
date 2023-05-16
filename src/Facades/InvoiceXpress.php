<?php

namespace Squarebit\InvoiceXpress\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Squarebit\InvoiceXpress\InvoiceXpress
 */
class InvoiceXpress extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Squarebit\InvoiceXpress\InvoiceXpress::class;
    }
}
