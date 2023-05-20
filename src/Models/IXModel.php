<?php

namespace Squarebit\InvoiceXpress\Models;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Squarebit\InvoiceXpress\API\IXEndpoint;
use Squarebit\InvoiceXpress\Concerns\HasAttributes;

abstract class IXModel implements Arrayable, ArrayAccess, Jsonable
{
    use HasAttributes;

    /*
     * The entity's ID
     */
    public ?int $id;

    abstract public function getEndpoint(): IXEndpoint;

    /*
     * Forwards undefined method calls to the endpoint
     */
    public function __call($name, $arguments)
    {
        return $this->getEndpoint()->$name(...$arguments);
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}
