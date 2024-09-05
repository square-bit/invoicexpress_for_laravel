<?php

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\SequenceData;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can create / get / update / delete a Sequence', function (string $name) {
    // create the sequence
    expect($sequence = InvoiceXpress::sequences()->create(SequenceData::fromName($name)))
        ->name->toBe($name);

    // get it
    expect(InvoiceXpress::sequences()->get($sequence->id))
        ->name->toBe($name);

    // list
    expect(InvoiceXpress::sequences()->list())
        ->toBeInstanceOf(EntityListData::class)
        ->sequences()->count()->toBeGreaterThanOrEqual(1); // we accept greaterThan since the account might have more Clients

    // set it as default
    expect(fn () => InvoiceXpress::sequences()->setCurrent($sequence->id))
        ->not()->toThrow(RequestException::class);

})->with([
    fake()->colorName(),
])->skip(! TEST_REAL_API);
