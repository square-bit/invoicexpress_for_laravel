<?php

namespace Squarebit\InvoiceXpress\API\Enums;

enum EstimateTypeEnum: string
{
    case Quote = 'Quote';
    case Proforma = 'Proforma';
    case FeesNote = 'FeesNote';
}
