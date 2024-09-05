<?php

use Squarebit\InvoiceXpress\Database\Factories\IxItemFactory;
use Squarebit\InvoiceXpress\Models\IxSimplifiedInvoice;

it('can add an Item', function () {

    $invoice = new IxSimplifiedInvoice;
    $item = IxItemFactory::new()->make();

    $invoice->addItem($item);

    expect($invoice)
        ->items->toHaveCount(1);
});

it('can add an Item from array', function () {

    $invoice = new IxSimplifiedInvoice;
    $item = IxItemFactory::new()->make()->toArray();

    $invoice->addItem($item);

    expect($invoice)
        ->items->toHaveCount(1);
});

it('can add Items', function () {

    $invoice = new IxSimplifiedInvoice;
    $item = IxItemFactory::new()->make();

    $invoice->addItems([$item, $item, $item]);

    expect($invoice)
        ->items->toHaveCount(3);
});
