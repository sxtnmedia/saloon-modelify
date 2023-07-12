<?php

namespace Sxtnmedia\SaloonModelify\Traits;

trait HasWhere
{
    protected array $where = [];

    public function where(mixed $key, mixed $val = null): self
    {
        if ($key) {
            if (is_array($key)) {
                $this->where = array_merge($this->where, $key);
            } elseif ($val !== null) {
                $this->where[$key] = $val;
            }
        }

        return $this;
    }
}
