<?php

namespace Squarebit\InvoiceXpress\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\RequestException;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Spatie\LaravelData\WithData;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Throwable;

abstract class IxModel extends Model
{
    use WithData{ getData as getDataBase; }

    protected Endpoint $endpoint;

    protected ?bool $persist = null;

    public $incrementing = false;

    abstract protected function getEndpoint(): Endpoint;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->endpoint = $this->getEndpoint();
        $this->persist ??= config('invoicexpress-for-laravel.eloquent.persist');
    }

    public function getData(): EntityData
    {
        /** @var EntityData $data */
        $data = $this->getDataBase();

        return $data;
    }

    public static function find($id, $columns = ['*'])
    {
        $instance = new static();
        if ($found = $instance->findLocally($id, $columns)) {
            return $found;
        }

        if (($data = $instance->findRemotely($id)) === null) {
            return null;
        }

        $model = $instance->updateModelFromData($data);
        $model->saveLocally();

        return $model;
    }

    public function findRemotely(int $id): ?EntityData
    {
        try {
            return $this->endpoint->get($id);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * @throws Throwable
     */
    public function save(array $options = [], bool $localOnly = false): bool
    {
        if (! $localOnly) {
            $this->saveRemotely();
        }

        return $this->saveLocally($options);
    }

    public function delete(bool $localOnly = false): bool
    {
        if (! $localOnly) {
            $this->deleteRemotely();
        }

        return $this->deleteLocally();

    }

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws InvalidDataClass
     */
    public function refreshFromIX(): ?static
    {
        return $this->updateModelFromData($this->findRemotely($this->getData()->getId()));
    }

    /**
     * @throws RequestException
     * @throws Throwable
     */
    protected function createRemotely(): EntityData
    {
        return $this->endpoint->create($this->getData());
    }

    protected function saveRemotely(): ?static
    {
        try {
            if (filled($this->getData()->getId())) {
                // update
                $this->endpoint->update($this->getData());
            } else {
                // create
                $this->updateModelFromData($this->createRemotely());
            }
        } catch (RequestException|InvalidDataClass|Throwable $e) {
            return null;
        }

        return $this;
    }

    protected function saveLocally(array $options = []): bool
    {
        if (! $this->persist) {
            return true;
        }

        return parent::save($options);
    }

    protected function findLocally($id, array $columns = ['*']): static|Collection|null
    {
        if (! $this->persist) {
            return null;
        }

        return $this->newModelQuery()->find($id, $columns);
    }

    protected function deleteRemotely(): bool
    {
        if (! filled($this->getKey())) {
            return false;
        }

        $this->endpoint->delete($this->getKey());

        return true;
    }

    protected function deleteLocally(): bool
    {
        if (! $this->persist) {
            return true;
        }

        return parent::delete();
    }

    protected function updateModelFromData(EntityData $data): static
    {
        return $this->forceFill($data->toArray());
    }
}
