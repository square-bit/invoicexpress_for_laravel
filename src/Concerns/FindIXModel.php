<?php

namespace Squarebit\InvoiceXpress\Concerns;

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

    public function get(int $id): ?static
    {
        try {
            $modelData = $this->getEndpoint()->get($id);
            $this->id = $id;
            $this->dataRootObjectName = array_keys($modelData)[0] ?? null;
            $this->attributes = $modelData[$this->dataRootObjectName] ?? [];

            return $this;
        } catch (RequestException) {
        }

        return null;
    }
}
