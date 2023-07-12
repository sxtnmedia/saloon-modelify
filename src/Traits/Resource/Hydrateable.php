<?php

namespace Sxtnmedia\SaloonModelify\Traits\Resource;

trait Hydrateable
{
    protected bool $isHydrated = false;

    public function isHydrated(): bool
    {
        return $this->isHydrated;
    }

    public function hydrate(array $attributes): self
    {
        $this->setAttributes($attributes);

        $this->isHydrated = true;

        return $this;
    }
}
