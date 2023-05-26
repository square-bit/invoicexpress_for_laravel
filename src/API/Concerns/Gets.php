<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Throwable;

/**
 * @template TData of EntityData
 */
trait Gets
{
    use GetsWithType {
        get as getWithType;
    }

    public const GET = 'get';

    abstract protected function getEntityType(): EntityTypeEnum;

    /**
     * @return TData
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function get(int $id): EntityData
    {
        return $this->getWithType($this->getEntityType(), $id);
    }
}
