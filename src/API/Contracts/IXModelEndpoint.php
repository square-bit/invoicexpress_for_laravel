<?php

namespace Squarebit\InvoiceXpress\API\Contracts;

use Illuminate\Http\Client\RequestException;
use Spatie\LaravelData\Data;
use Throwable;

/**
 * @template TData of Data
 */
interface IXModelEndpoint
{
    /**
     * @param  TData  $modelData
     * @return TData
     *
     * @throws RequestException|Throwable
     */
    public function create(Data $modelData): Data;

    public function list(int $page = 1, int $perPage = 30): ?array;

    public function update(int|array $id, array|Data $data): void;
}
