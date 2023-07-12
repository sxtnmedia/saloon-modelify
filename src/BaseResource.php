<?php

namespace Sxtnmedia\SaloonModelify;

use Saloon\Contracts\Request;
use Saloon\Traits\Request\HasConnector;
use Sxtnmedia\SaloonModelify\Enums\Action;
use Sxtnmedia\SaloonModelify\Traits\ForwardsCalls;
use Sxtnmedia\SaloonModelify\Traits\HasRelations;
use Sxtnmedia\SaloonModelify\Traits\Resource\HasAttributes;
use Sxtnmedia\SaloonModelify\Traits\Resource\HasKey;
use Sxtnmedia\SaloonModelify\Traits\Resource\Hydrateable;

class BaseResource
{
    use HasKey;
    use HasAttributes;
    use ForwardsCalls;
    use HasConnector;
    use HasRelations;
    use Hydrateable;

    protected string $requestClass = '';
    protected ?Request $request = null;

    public function __construct(mixed $attributes = [], $parent = null)
    {
        if (!empty($attributes)) {
            // If passed attributes is not array, assume its primary key value
            if (!is_array($attributes)) {
                $attributes = [
                    $this->getKeyName() => $attributes,
                ];
            }

            $this->setAttributes($attributes);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        return (new static())->proxy($name, $arguments);
    }

    public function __call($name, $arguments)
    {
        return $this->proxy($name, $arguments);
    }

    public function __get($name)
    {
        if (method_exists($this, $name)) {
            $relation = $this->fetchRelation($name);
            if ($relation) {
                return $relation;
            }
        }

        return $this->getAttribute($name);
    }

    public function __set($name, $value)
    {
        return $this->setAttribute($name, $value);
    }

    public function resolveEntityEndpoint()
    {
        return $this->resolveBaseEndpoint().'/{id}';
    }

    public function resolveBaseEndpoint()
    {
        return '/';
    }

    public function resolveEndpoint(Action $action)
    {
        return match ($action) {
            Action::FIND, Action::DELETE, Action::UPDATE => $this->resolveEntityEndpoint(),
            Action::GET, Action::CREATE => $this->resolveBaseEndpoint()
        };
    }

    public function request(): Request
    {
        return $this->request ??= $this->resolveRequest();
    }

    public function setRequest(Request $request): static
    {
        $this->request = $request;

        return $this;
    }

    public function resolveRequest(): Request
    {
        return (new ($this->requestClass)())->setResource($this);
    }

    protected function proxy($name, $arguments)
    {
        return $this->forwardDecoratedCallTo($this->request($this), $name, $arguments);
    }
}
