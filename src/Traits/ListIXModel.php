<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\Models\EntityList;

trait ListIXModel
{
    public static function list(int $page = 1, int $perPage = 30): ?EntityList
    {
        $instance = new static();
        try {
            $data = $instance->getEndpoint()->list($page, $perPage);
            $pagination = $data['pagination'];
            unset($data['pagination']);

            return new EntityList($instance, collect($data)->flatten(1), $pagination);
        } catch (RequestException) {
        }

        return null;
    }
}
