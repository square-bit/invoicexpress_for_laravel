<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Assert;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Tests\TestCase;
use Squarebit\InvoiceXpress\Tests\TestCaseWithDB;

use function Pest\testDirectory;

const TEST_REAL_API = false;

uses(TestCase::class)->in('API_REAL', 'API_FAKED', 'Unit');
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

function getRequestSample(string $endpoint, string $action, ?EntityTypeEnum $entityType = null): ?array
{
    return getSample($endpoint, $action.($entityType ? '-'.$entityType->value : ''), 'request');
}

function getResponseSample(string $endpoint, string $action, ?EntityTypeEnum $entityType = null): ?array
{
    return getSample($endpoint, $action.($entityType ? '-'.$entityType->value : ''), 'response');
}

function getSample(string $endpoint, string $action, string $type): ?array
{
    return json_decode(
        file_get_contents(testDirectory('Samples/'.$endpoint.'/'.$action.'-sample-'.$type.'.json')),
        true
    );
}
