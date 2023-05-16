<?php

use Squarebit\InvoiceXpress\Tests\TestCase;
use function Pest\testDirectory;

uses(TestCase::class)->in(__DIR__);

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
    try {
        return json_decode(
            file_get_contents(testDirectory('Samples/' . $ixEntity . '/' . $action . '-sample-' . $type . '.json')),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
    } catch (\Throwable) {
        return [];
    }
}
