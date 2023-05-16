<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiList
{
    public const LIST = 'list';

    /**
     * @throws RequestException
     */
    public function list(): ?array
    {
        return $this->call('list');
    }
}
