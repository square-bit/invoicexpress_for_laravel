<?php

namespace Squarebit\InvoiceXpress\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\RequestException;
use InvalidArgumentException;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Spatie\LaravelData\WithData;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\InvoiceXpress;
use Throwable;

/**
 * @template T of EntityData
 *
 * @phpstan-consistent-constructor
 */
abstract class IxModel extends Model
{
    use WithData{ getData as getBaseData; }

    /** @var Endpoint<T> */
    protected Endpoint $endpoint;

    protected EntityTypeEnum $entityType;

    /** @var class-string<T> */
    protected string $dataClass;

    protected bool $persist = false;

    public $incrementing = false;

    protected $guarded = [];

    /**
     * @return Endpoint<T>
     */
    abstract public function getEndpoint(): Endpoint;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->endpoint = $this->getEndpoint();
        $this->persist = config('invoicexpress-for-laravel.eloquent.persist');
    }

    public function getEntityType(): EntityTypeEnum
    {
        return $this->entityType;
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

    /**
     * @return T
     */
    public function getData(): EntityData
    {
        /** @var EntityData $data */
        $data = $this->getBaseData();

        return $data;
    }

    /**
     * @return IxModel<T>|Collection<int, IxModel<T>>|null
     */
    public static function find(int $id, array $columns = ['*']): self|Collection|null
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
            return $this->endpoint->get($this->entityType, $id);
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
        return $this->endpoint->create($this->entityType, $this->getData());
    }

    protected function saveRemotely(): bool
    {
        try {
            if (filled($this->getData()->getId())) {
                /** @phpstan-ignore-next-line */
                $this->endpoint->update($this->entityType, $this->getData());
            } else {
                $this->fromData($this->createRemotely());
            }

            return true;
        } catch (RequestException|InvalidDataClass $e) {
            return false;
        }
    }

    public function saveLocally(array $options = []): bool
    {
        if (! $this->persist) {
            return true;
        }

        return parent::save($options);
    }

    /**
     * @return IxModel<T>|Collection<int, IxModel<T>>|null
     */
    protected function findLocally(int $id, array $columns = ['*']): self|Collection|null
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

    public function fromData(EntityData|array $data): static
    {
        $dataClass = $this->dataClass;
        $data = match (true) {
            is_array($data) => $dataClass::from($data),
            default => $data,
        };

        if (! $data instanceof $this->dataClass) {
            throw new InvalidArgumentException("The given value is not a $this->dataClass instance.");
        }

        return $this->fill($data->all());
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format(InvoiceXpress::DATE_FORMAT);
    }
}
