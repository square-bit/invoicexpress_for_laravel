<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;

trait FindIXEntity
{
    /*
     * Use to extract a (sub)key from the json(array) response
     */
    protected ?string $apiResponseObject = null;

    /*
     * The entity's ID
     */
    public ?int $id;

    public static function find(int $id): ?static
    {
        $instance = new static();
        try {
            $modelData = $instance->get($id);
            $instance->id = $id;
            $instance->attributes = Arr::get($modelData, $instance->apiResponseObject);

            return $instance;
        } catch (RequestException) {
        }

        return null;
    }
}
