<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait FindIXModel
{
    /*
     * Used to store the root object name from the Get response.
     * Example: when we GET a IXClient the response body is:
     * {
     *   'client': {
     *     'id': '1',
     *     'name': 'Ricardo Pereira',
     *     ...
     * Here we store the string 'client' to be used in other API calls such as Update
     */
    private ?string $dataRootObjectName;

    public static function find(int $id): ?static
    {
        $instance = new static();
        try {
            $modelData = $instance->getEndpoint()->get($id);
            $instance->id = $id;
            $instance->dataRootObjectName = array_keys($modelData)[0] ?? null;
            $instance->attributes = $modelData[$instance->dataRootObjectName] ?? [];

            return $instance;
        } catch (RequestException) {
        }

        return null;
    }
}
