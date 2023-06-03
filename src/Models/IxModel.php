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

/** @phpstan-consistent-constructor */
abstract class IxModel extends Model
{
    use WithData{ getData as getDataBase; }

    protected Endpoint $endpoint;

    protected bool $persist = false;

    public $incrementing = false;

    abstract protected function getEndpoint(): Endpoint;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->endpoint = $this->getEndpoint();
        $this->persist = config('invoicexpress-for-laravel.eloquent.persist');
    }

    public function persistLocally(bool $persist = true): static
    {
        $this->persist = $persist;

        return $this;
    }

    public function isPersistingLocally(): bool
    {
        return $this->persist;
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

        $model = $instance->fromData($data);
        $model->saveLocally();

        return $model;
    }

    public function findRemotely(int $id): ?EntityData
    {
        try {
            /** @phpstan-ignore-next-line */
            return $this->endpoint->get($id);
        } catch (RequestException) {
            return null;
        }
    }

    /**
     * @throws Throwable
     */
    public function save(array $options = []): bool
    {
        if ($this->saveRemotely() === false) {
            return false;
        }

        return $this->persist ? $this->saveLocally($options) : true;
    }

    public function delete(): bool
    {
        if ($this->deleteRemotely() === false) {
            return false;
        }

        return $this->deleteLocally();
    }

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws InvalidDataClass
     */
    public function refreshFromRemote(): ?static
    {
        return $this->fromData($this->findRemotely($this->getData()->getId()));
    }

    /**
     * @throws RequestException
     * @throws Throwable
     */
    protected function createRemotely(): EntityData
    {
        /** @phpstan-ignore-next-line */
        return $this->endpoint->create($this->getData());
    }

    protected function saveRemotely(): bool
    {
        try {
            if (filled($this->getData()->getId())) {
                // update
                /** @phpstan-ignore-next-line */
                $this->endpoint->update($this->getData());
            } else {
                // create
                $this->fromData($this->createRemotely());
            }

            return true;
        } catch (RequestException|InvalidDataClass $e) {
            return false;
        }
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

        /** @phpstan-ignore-next-line */
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

    protected function fromData(EntityData $data): static
    {
        return $this->forceFill($data->toArray());
    }
}
