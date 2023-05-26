<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
use Throwable;

/**
 * @template T of EntityData
 */
trait IXApiUpdate
{
    use IXApiUpdateWithType {
        update as updateWithType;
    }

    public const UPDATE = 'update';

    abstract protected function getDocumentType(): DocumentTypeEnum;

    /**
     * @param  T  $data
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function update(int $id, EntityData $data): void
    {
        $this->updateWithType($this->getDocumentType(), $id, $data);
    }
}
