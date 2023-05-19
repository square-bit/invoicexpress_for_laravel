<?php

namespace Squarebit\InvoiceXpress\API\Enums;

enum GuideTypeEnum: string
{
    case Shippings = 'shippings';
    case Transports = 'transports';
    case Devolutions = 'devolutions';
}
