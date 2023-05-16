<?php

namespace Squarebit\InvoiceXpress\Models;

/*
 * This is the InvoiceXpress Client, i.e., your company's paying customer.
 */

use Illuminate\Http\Client\RequestException;

class IXClient extends IXEntity
{
    protected static string $endpointConfig = 'client';
    public const LIST = 'list';
    public const GET = 'get';
    public const UPDATE = 'update';
    public const CREATE = 'create';
    public const FIND_BY_NAME = 'find-by-name';
    public const LIST_INVOICES = 'list-invoices';

    /**
     * @return array|null
     * @throws RequestException
     */
    public function list(): ?array
    {
        return $this->call('list');
    }

    /**
     * @param  int  $id
     * @return array|null
     * @throws RequestException
     */
    public function get(int $id): ?array
    {
        return $this->call(
            action: 'get',
            urlParams: ['id' => $id]
        );
    }

    /**
     * Updates the current Client. Must get() one first
     * @throws RequestException
     */
    public function update(int $id, array $data = []): void
    {
        $this->call(
            action: 'update',
            urlParams: ['id' => $id],
            bodyData: $data);
    }

    /**
     * @param $data array {
     *      client: array {
     *          name: 'Client Name',
     *          code: string,
     *          email: string,
     *          language: string,
     *          address: string,
     *          city: string,
     *          postal_code: string,
     *          country: string,
     *          fiscal_id: string,
     *          website: string,
     *          phone: string,
     *          fax: string,
     *          preferred_contact: array {,
     *              name: string,
     *              email: string,
     *              phone: string
     *          }
     *          observations: string,
     *          send_options: strin
     *      }
     * }
     * @throws RequestException
     */
    public function create(array $data): array
    {
        return $this->call(
            action: 'create',
            bodyData: ['client' => $data]);
    }

    public function findByName(string $name): ?array
    {
        return $this->call(
            action: 'find-by-name',
            queryParams: ['client_name' => $name]
        );
    }

    public function listInvoices(int $id): ?array
    {
        return $this->call(
            action: 'list-invoices',
            urlParams: ['id' => $id],
        );
    }

    public function delete(int $id): ?array
    {
        return $this->call(
            action: 'delete',
            urlParams: ['id' => $id]
        );
    }
}
