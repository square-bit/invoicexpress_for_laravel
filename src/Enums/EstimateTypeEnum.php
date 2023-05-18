<?php

namespace Squarebit\InvoiceXpress\Enums;

enum EstimateTypeEnum: string
{
    case Quotes = 'quotes';
    case Proformas = 'proformas';
    case FeesNotes = 'fees_notes';
}
