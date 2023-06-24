<?php

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can get the SAFT', function (int $year, int $month) {

    expect(fn () => InvoiceXpress::saft()->export($year, $month))
        ->not()->toThrow(RequestException::class)
        ->toBeInstanceOf(TaxData::class);

})->with([
    [2023, 4],
])->skip(! TEST_REAL_API)
    ->skip('SAFT not available in trial');
