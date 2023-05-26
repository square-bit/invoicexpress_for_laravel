<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Throwable;

/**
 * @template TData of EntityData
 */
trait Creates
{
    use CreatesWithType {
        create as createWithType;
    }

    public const CREATE = 'create';

    abstract protected function getEntityType(): EntityTypeEnum;

    /**
     * @param  TData  $data
     * @return TData
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function create(EntityData $data): EntityData
    {
        return $this->createWithType($this->getEntityType(), $data);
    }
}
