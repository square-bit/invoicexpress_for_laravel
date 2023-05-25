<?php

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\Enums\IXClientLanguageEnum;
use Squarebit\InvoiceXpress\Enums\IXClientSendOptionsEnum;
use Squarebit\InvoiceXpress\Enums\IXTaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can create / update /delete a client', function (array $clientData) {
    // create the client
    /** @var ClientData $client */
    $client = InvoiceXpress::client()->create(ClientData::from($clientData));

    // get it
    /** @var ClientData $gotClient */
    $gotClient = InvoiceXpress::client()->get($client->id);
    expect($gotClient->toArray())->toMatchArrayRecursive($clientData);

    // update it
    $description = $gotClient->address = fake()->streetAddress();
    InvoiceXpress::client()->update($gotClient->id, $gotClient);

    // confirm it was updated, delete it and confirm it is gone
    /** @var ClientData $gotClient */
    $gotClient = InvoiceXpress::client()->get($gotClient->id);
    expect($gotClient->address)
        ->toEqual($description)
        ->and(fn () => InvoiceXpress::client()->delete($gotClient->id))
        /** Deleting Client throws an exception but deletes it anyway if it has no documents
         *  See https://github.com/square-bit/invoicexpress_for_laravel/issues/1
         */
        // ->not()->toThrow(Exception::class)
        ->toThrow(Exception::class)
        ->and(fn () => InvoiceXpress::client()->get($gotClient->id))
        ->toThrow(RequestException::class);
})->with([
    [
        [
            'name' => fake()->name(),
            'code' => fake()->randomNumber(8),
            'language' => collect(IXClientLanguageEnum::values())->random(),
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
            'send_options' => collect(IXClientSendOptionsEnum::values())->random(),
            'payment_days' => fake()->numberBetween(0, 60),
            'tax_exemption_code' => collect(IXTaxExemptionCodeEnum::values())->random(),
        ],
    ],
]);