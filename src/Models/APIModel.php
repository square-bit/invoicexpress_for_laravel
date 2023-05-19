<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\IXEndpoint;
use Squarebit\InvoiceXpress\Traits\FindIXEntity;
use Squarebit\InvoiceXpress\Traits\HasAttributes;
use Squarebit\InvoiceXpress\Traits\UpdateIXEntity;

abstract class APIModel
{
    use HasAttributes;
    use FindIXEntity;
    use UpdateIXEntity;

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
