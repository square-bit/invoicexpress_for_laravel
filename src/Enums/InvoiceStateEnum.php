<?php

namespace Squarebit\InvoiceXpress\Enums;

enum InvoiceStateEnum: string
{
    case Finalized = 'finalized';
    case Deleted = 'deleted';
    case SecondCopy = 'second_copy';
    case Canceled = 'canceled';
    case Settled = 'settled';
    case Unsettled = 'unsettled';
}
