<?php

namespace Squarebit\InvoiceXpress\API\Enums;

enum GuideTypeEnum: string
{
    case Shipping = 'Shipping';
    case Transport = 'Transport';
    case Devolution = 'Devolution';
}
