<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Database\Eloquent\MissingAttributeException;

trait HasAttributes
{
    protected array $attributes = [];

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttributes(array $data): static
    {
        $this->attributes = $data;

        return $this;
    }

    public function getAttribute($key): mixed
    {
        return $this->attributes[$key] ?? null;
    }

    public function setAttribute(string $key, $value): void
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Dynamically retrieve attributes on the model.
     */
    public function __get(string $key): mixed
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the model.
     */
    public function __set(string $key, mixed $value): void
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Determine if the given attribute exists.
     */
    public function offsetExists(mixed $offset): bool
    {
        try {
            return !is_null($this->getAttribute($offset));
        } catch (MissingAttributeException) {
            return false;
        }
    }

    /**
     * Get the value for a given offset.
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->getAttribute($offset);
    }

    /**
     * Set the value for a given offset.
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->setAttribute($offset, $value);
    }

    /**
     * Unset the value for a given offset.
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->attributes[$offset], $this->relations[$offset]);
    }

    /**
     * Determine if an attribute or relation exists on the model.
     */
    public function __isset(string $key)
    {
        return $this->offsetExists($key);
    }

    /**
     * Unset an attribute on the model.
     */
    public function __unset(string $key)
    {
        $this->offsetUnset($key);
    }

    public function toArray(): array
    {
        return array_merge($this->attributes);
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function toJson($options = 0): ?string
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }

    /**
     * Convert the model to its string representation.
     */
    public function __toString(): string
    {
        return $this->toJson() ?? '';
    }
}
