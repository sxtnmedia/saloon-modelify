<?php

namespace Sxtnmedia\SaloonModelify\Traits\Resource;

trait HasAttributes
{
    protected array $attributes = [];

    public function setAttributes(array $data): self
    {
        $this->attributes = array_merge($this->attributes, $data);

        return $this;
    }

    public function setAttribute(string $key, mixed $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getAttribute(string $key, mixed $default = null): mixed
    {
        return $this->attributes[$key] ?? $default;
    }

    public function toArray(): array
    {
        return $this->attributes;
    }
}
