<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

use Squarebit\InvoiceXpress\API\Enums\PaymentMechanismEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;

it('can return a label for enum', function ($paymentMechanism) {

    expect($paymentMechanism->label())
        ->not()->toBe($paymentMechanism->value)
        ->not()->toBe($paymentMechanism->name);

})->with([
    PaymentMechanismEnum::cases(),
    TaxExemptionCodeEnum::cases(),
]);
