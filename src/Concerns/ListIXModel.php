<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\Models\IXEntityList;

trait ListIXModel
{
    protected const PAGINATION_TAG = 'pagination';

    public static function list(int $page = 1, int $perPage = 30): ?IXEntityList
    {
        $instance = new self();
        try {
            $data = $instance->getEndpoint()->list($page, $perPage);
            $pagination = $data[self::PAGINATION_TAG];
            unset($data[self::PAGINATION_TAG]);

            return new IXEntityList($instance, collect($data)->flatten(1), $pagination);
        } catch (RequestException) {
        }

        return null;
    }
}
