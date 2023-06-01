<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\testDirectory;
use PHPUnit\Framework\Assert;
use Squarebit\InvoiceXpress\Tests\TestCase;
use Squarebit\InvoiceXpress\Tests\TestCaseWithDB;

uses(TestCase::class)->in('API_REAL', 'API_FAKED');
uses(TestCaseWithDB::class, RefreshDatabase::class)->in('Feature');

expect()->extend('toMatchArrayRecursive', function (array $array) {
    $valueAsArray = (array) $this->value;

    foreach ($array as $key => $value) {
        Assert::assertArrayHasKey($key, $valueAsArray);

        if (is_array($value)) {
            Assert::assertIsArray($valueAsArray[$key]);
            expect($valueAsArray[$key])->toMatchArrayRecursive($value);

            continue;
        }

        Assert::assertEquals(
            $value,
            $valueAsArray[$key],
            sprintf(
                'Failed asserting that an array has a key %s with the value %s.',
                $key,
                $valueAsArray[$key],
            ),
        );
    }

    return $this;
});

function getRequestSample(string $ixEntity, string $action): ?array
{
    return getSample($ixEntity, $action, 'request');
}

function getResponseSample(string $ixEntity, string $action): ?array
{
    return getSample($ixEntity, $action, 'response');
}

function getSample(string $ixEntity, string $action, string $type): ?array
{
    return json_decode(
        file_get_contents(testDirectory('Samples/'.$ixEntity.'/'.$action.'-sample-'.$type.'.json')),
        true
    );
}
