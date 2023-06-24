<?php

use Squarebit\InvoiceXpress\Enums\ClientLanguageEnum;
use Squarebit\InvoiceXpress\Enums\ClientSendOptionsEnum;
use Squarebit\InvoiceXpress\Enums\CountryEnum;
use Squarebit\InvoiceXpress\Enums\PaymentMechanismEnum;
use Squarebit\InvoiceXpress\Enums\TaxExemptionCodeEnum;

it('can return a label for enum', function ($paymentMechanism) {

    expect($paymentMechanism->label())
        ->not()->toBe($paymentMechanism->value)
        ->not()->toBe($paymentMechanism->name);

})->with([
    PaymentMechanismEnum::cases(),
    TaxExemptionCodeEnum::cases(),
    ClientSendOptionsEnum::cases(),
]);

it('can return a label even if note defined', function ($paymentMechanism) {

    expect($paymentMechanism->label())
        ->toBe($paymentMechanism->value);

})->with([
    ClientLanguageEnum::cases(),
    CountryEnum::cases(),
]);

it('can return options', function ($paymentMechanism) {

    expect($paymentMechanism->options())
        ->toBeArray()
        ->toHaveCount(count($paymentMechanism::cases()));

})->with([
    PaymentMechanismEnum::cases(),
    TaxExemptionCodeEnum::cases(),
    ClientSendOptionsEnum::cases(),
]);
