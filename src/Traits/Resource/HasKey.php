<?php

namespace Sxtnmedia\SaloonModelify\Traits\Resource;

trait HasKey
{
    protected string $primaryKey = 'id';

    public function setKeyName(string $name): self
    {
        $this->primaryKey = $name;

        return $this;
    }

    public function getKeyName(): string
    {
        return $this->primaryKey;
    }

    public function getKey(): mixed
    {
        return $this->getAttribute($this->getKeyName());
    }

    public function setKey(mixed $value): self
    {
        return $this->setAttribute($this->getKeyName(), $value);
    }

    abstract public function getAttribute(string $key, mixed $default = null);

    abstract public function setAttribute(string $key, $value);
}
