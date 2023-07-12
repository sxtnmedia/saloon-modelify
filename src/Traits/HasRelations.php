<?php

namespace Sxtnmedia\SaloonModelify\Traits;

use Sxtnmedia\SaloonModelify\BaseResource as Resource;
use Sxtnmedia\SaloonModelify\Helpers\Helper;
use Sxtnmedia\SaloonModelify\Relations\BelongsTo;
use Sxtnmedia\SaloonModelify\Relations\HasMany;
use Sxtnmedia\SaloonModelify\Relations\Relation;

trait HasRelations
{
    protected array $relations = [];
    protected ?Resource $parent = null;

    public function hasParentOfClass($class)
    {
        return $this->hasParent() && get_class($this->getParent()) === $class;
    }

    public function hasParent()
    {
        return isset($this->parent);
    }

    public function getParent(): ?Resource
    {
        return $this->parent ?? null;
    }

    public function setParent($object): self
    {
        $this->parent = $object;

        return $this;
    }

    public function fetchRelation($name)
    {
        $resource = $this->{$name}();
        if ($resource instanceof Relation) {
            $return = $resource->isHydrated() ? $resource->getObject() : $resource->get();
            if ($resource instanceof HasMany) {
                return $return;
            }

            return $return->first();
        }
    }

    public function resolveRelatedTo(string $class)
    {
        if ($this->hasParentOfClass($class)) {
            return $this->getParent();
        }

        return $class;
    }

    public function hasMany(string $class, array $attributes = []): Relation|Resource
    {
        $relationName = Helper::getCaller();

        return $this->relations[$relationName] ??= new HasMany($this, $this->resolveRelatedTo($class), $attributes);
    }

    public function belongsTo(string $class, $foreignKey = null, $localKey = 'id'): Relation|Resource
    {
        $relationName = Helper::getCaller();

        return $this->relations[$relationName] ??= new BelongsTo($this, $this->resolveRelatedTo($class), $foreignKey, $localKey);
    }
}
