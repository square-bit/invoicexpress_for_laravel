<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Throwable;

/**
 * @template T of EntityData
 */
trait Updates
{
    use UpdatesWithType {
        update as updateWithType;
    }

    public const UPDATE = 'update';

    abstract protected function getEntityType(): EntityTypeEnum;

    /**
     * @param  T  $data
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function update(int $id, EntityData $data): void
    {
        $this->updateWithType($this->getEntityType(), $id, $data);
    }
}
