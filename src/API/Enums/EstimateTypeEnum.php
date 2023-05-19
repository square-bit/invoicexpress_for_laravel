<?php

namespace Squarebit\InvoiceXpress\API\Enums;

enum EstimateTypeEnum: string
{
    case Quotes = 'quotes';
    case Proformas = 'proformas';
    case FeesNotes = 'fees_notes';
}
