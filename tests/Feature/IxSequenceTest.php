<?php

use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\Models\IxSequence;

it('will fail to find a nonexistent Sequence', function () {
    $id = random_int(1, 10000);
    Http::fake([
        "https://*.app.invoicexpress.com/sequences/{$id}.json?*" => Http::response(null, 404),
    ]);

    // fail to find the item since we'll get a 404
    expect(IxSequence::find($id))->toBeNull()
        ->and(IxSequence::count())->toBe(0);

});

it('can create a Sequence', function (bool $persistLocally) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);

    $instance = new IxSequence();
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();

    $requestSample = getRequestSample(class_basename($endpoint), $endpoint::CREATE);
    $responseSample = getResponseSample(class_basename($endpoint), $endpoint::CREATE, $type);

    $instance->forceFill($requestSample);

    Http::fake([
        'https://*.app.invoicexpress.com/sequences.json?*' => Http::response($responseSample),
    ]);
    expect($instance->save())->toBeTrue()
        ->and($instance->exists)->toBe($persistLocally)
        ->and($instance->toArray())->toMatchArrayRecursive(reset($responseSample))
        ->and(IxSequence::count())->toBe($persistLocally ? 1 : 0);

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
]);

it('can find a Sequence', function (bool $persistLocally) {
    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);

    $instance = new IxSequence();
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();
    $responseSample = getResponseSample(class_basename($endpoint), $endpoint::GET, $type);
    $id = reset($responseSample)['id'];

    Http::fake([
        "https://*.app.invoicexpress.com/sequences/{$id}.json?*" => Http::response($responseSample),
    ]);

    expect($instance = $instance::find($id))->toBeInstanceOf(IxSequence::class)
        ->and($instance->exists)->toBe($persistLocally)
        ->and($instance->toArray())->toMatchArrayRecursive(reset($responseSample))
        ->and(IxSequence::count())->toBe($persistLocally ? 1 : 0);

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
]);

it('can set a Sequence as default', function (bool $persistLocally) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);

    $instance = new IxSequence();
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();
    $GETResponseSample = getResponseSample(class_basename($endpoint), $endpoint::GET, $type);
    $id = reset($GETResponseSample)['id'];

    Http::fake([
        "https://*.app.invoicexpress.com/sequences/{$id}.json?*" => Http::response($GETResponseSample),
    ]);

    expect($instance = IxSequence::find($id))
        ->toBeInstanceOf(IxSequence::class);

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}/set_current.json?*" => Http::response(),
    ]);

    expect($instance->setCurrent())->toBeTrue()
        ->and($instance->exists)->toBe($persistLocally);

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
]); // ->depends('it can create a Sequence');

it('can fail to update a Sequence', function (bool $persistLocally) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);

    $instance = new IxSequence();
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();
    $GETResponseSample = getResponseSample(class_basename($endpoint), $endpoint::GET, $type);
    $id = reset($GETResponseSample)['id'];

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response($GETResponseSample),
        "https://*.app.invoicexpress.com/*/{$id}/set_current.json?*" => Http::response(null, 404),
    ]);

    $instance = IxSequence::find($id);
    expect($instance)->toBeInstanceOf(IxSequence::class)
        ->and($instance->setCurrent())->toBeFalse();
})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
]); //->depends('it can create a Sequence');

it('can refresh a Sequence from API', function (bool $persistLocally) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);

    $instance = new IxSequence();
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();
    $responseSample = getResponseSample(class_basename($endpoint), $endpoint::GET, $instance->getEntityType());
    $id = reset($responseSample)['id'];

    Http::fake([
        "https://*.app.invoicexpress.com/sequences/{$id}.json?*" => Http::response($responseSample),
    ]);

    expect($instance = IxSequence::find($id))->toBeInstanceOf(IxSequence::class);

    $modified = $instance->serie = fake()->text();

    expect($instance->refreshFromRemote())->toBeInstanceOf($instance::class)
        ->and($instance->exists)->toBe($persistLocally)
        ->and($instance->serie)->not()->toBe($modified);

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
])->depends('it can create a Sequence');
