<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiUpdate
{
    public const UPDATE = 'update';

    /**
     * @throws RequestException
     */
    public function update(int $id, array $data = []): void
    {
        $this->call(
            action: 'update',
            urlParams: ['id' => $id],
            bodyData: $data);
    }
}
