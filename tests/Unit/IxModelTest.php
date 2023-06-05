<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\Models\IxModel;

it('can set/unset persistance', function (bool $persistLocally) {

    $instance = new TestModel();
    expect($instance->isPersistingLocally())->toBe(config('invoicexpress-for-laravel.eloquent.persist'));

    $instance->persistLocally($persistLocally);
    expect($instance->isPersistingLocally())->toBe($persistLocally);

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
]);

class TestModel extends IxModel
{
    public function getEndpoint(): Endpoint
    {
        return new ClientsEndpoint();
    }
}
