<?php

namespace Squarebit\InvoiceXpress\API\Enums;

enum TaxCodeEnum: string
{
    case Normal = 'NOR';
    case Intermediate = 'INT';
    case Reduced = 'RED';
    case OtherRate = 'OUT';
    case Exempt = 'ISE';
}
