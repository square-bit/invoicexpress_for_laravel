<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

trait Registers
{
    use Lists;

    public const REGISTER = 'register';

    abstract protected function getEntityType(): EntityTypeEnum;

    /**
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function register(int $id): EntityListData
    {
        $response = $this->call(
            action: static::REGISTER,
            urlParams: compact('id')
        );

        return $this->handleListResponse($response);
    }
}
