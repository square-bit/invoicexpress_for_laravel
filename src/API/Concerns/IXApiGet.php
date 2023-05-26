<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
use Throwable;

/**
 * @template TData of EntityData
 */
trait IXApiGet
{
    use IXApiGetWithType {
        get as getWithType;
    }

    public const GET = 'get';

    abstract protected function getDocumentType(): DocumentTypeEnum;

    /**
     * @return TData
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function get(int $id): EntityData
    {
        return $this->getWithType($this->getDocumentType(), $id);
    }
}
