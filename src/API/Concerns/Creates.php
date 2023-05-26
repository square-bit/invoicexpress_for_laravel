<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
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

    abstract protected function getDocumentType(): DocumentTypeEnum;

    /**
     * @param  int  $id
     * @param  TData  $data
     * @return TData
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function create(EntityData $data): EntityData
    {
        return $this->createWithType($this->getDocumentType(), $data);
    }
}
