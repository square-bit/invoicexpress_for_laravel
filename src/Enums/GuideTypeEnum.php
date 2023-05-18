<?php

namespace Squarebit\InvoiceXpress\Enums;

enum GuideTypeEnum: string
{
    case Shippings = 'shippings';
    case Transports = 'transports';
    case Devolutions = 'devolutions';
}
