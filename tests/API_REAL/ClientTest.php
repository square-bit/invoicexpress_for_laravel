<?php

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\PaginationFilter;
use Squarebit\InvoiceXpress\Enums\ClientLanguageEnum;
use Squarebit\InvoiceXpress\Enums\ClientSendOptionsEnum;
use Squarebit\InvoiceXpress\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can create / get / findByCode|Name / list / update / delete a client', function (array $clientData) {
    // create the client
    /** @var ClientData $client */
    $client = InvoiceXpress::clients()->create(ClientData::from($clientData));

    // get it
    /** @var ClientData $gotClient */
    $gotClient = InvoiceXpress::clients()->get($client->id);
    expect($gotClient->toArray())->toMatchArrayRecursive($clientData);

    // find by code
    expect(InvoiceXpress::clients()->findByCode($clientData['code']))
        ->id->toBe($client->getId())
        ->and(fn () => InvoiceXpress::clients()->findByCode(fake()->realText(16)))
        ->toThrow(RequestException::class);

    // find by name
    expect(InvoiceXpress::clients()->findByName($clientData['name']))
        ->id->toBe($client->getId())
        ->and(fn () => InvoiceXpress::clients()->findByName(fake()->realText(16)))
        ->toThrow(RequestException::class);

    // list invoices
    expect(fn () => InvoiceXpress::clients()->listInvoices())
        ->not()->toThrow(RequestException::class);

    // list
    expect(InvoiceXpress::clients()->list())
        ->toBeInstanceOf(EntityListData::class)
        ->items()->count()->toBeGreaterThanOrEqual(1) // we accept greaterThan since the account might have more Clients
        ->and(InvoiceXpress::clients()->list(PaginationFilter::from(['per_page' => 1])))
        ->items()->count()->toBe(1);

    // update it
    $description = $gotClient->address = fake()->streetAddress();
    InvoiceXpress::clients()->update($gotClient);

    // confirm it was updated, delete it and confirm it is gone
    /** @var ClientData $gotClient */
    $gotClient = InvoiceXpress::clients()->get($gotClient->id);
    expect($gotClient->address)
        ->toEqual($description)
        ->and(fn () => InvoiceXpress::clients()->delete($gotClient->id))
        /** Deleting Client throws an exception but deletes it anyway if it has no documents
         *  See https://github.com/square-bit/invoicexpress_for_laravel/issues/1
         */
        // ->not()->toThrow(Exception::class)
        ->toThrow(Exception::class)
        ->and(fn () => InvoiceXpress::clients()->get($gotClient->id))
        ->toThrow(RequestException::class);
})->with([
    'Sample client' => [
        [
            'name' => fake()->name(),
            'code' => fake()->randomNumber(8),
            'language' => collect(ClientLanguageEnum::values())->random(),
            'email' => fake()->email(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
            'fiscal_id' => fake()->randomNumber(9),
            'website' => fake()->domainName(),
            'country' => collect(['Spain', 'Ireland'])->random(),
            'phone' => fake()->e164PhoneNumber(),
            'fax' => fake()->e164PhoneNumber(),
            'preferred_contact' => [
                'name' => fake()->name(),
                'email' => fake()->email(),
                'phone' => fake()->e164PhoneNumber(),
            ],
            'observations' => fake()->text(),
            'send_options' => collect(ClientSendOptionsEnum::values())->random(),
            'payment_days' => fake()->numberBetween(0, 60),
            'tax_exemption_code' => collect(TaxExemptionCodeEnum::names())->random(),
        ],
    ],
])->skip(! TEST_REAL_API);
