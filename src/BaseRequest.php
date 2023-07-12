<?php

namespace Sxtnmedia\SaloonModelify;

use Exception;
use Saloon\Contracts\PendingRequest;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Request\HasConnector;
use Sxtnmedia\SaloonModelify\Traits\HasWhere;

class BaseRequest extends Request
{
    use HasWhere;
    use HasConnector;

    protected Method $method;
    protected BaseResource $resource;
    protected string $endpoint;
    protected bool $removeAfterFoundWherePlaceholder = true;

    public function boot(PendingRequest $pendingRequest): void
    {
        $this->applyWhere($pendingRequest);
    }

    public function resolveConnector()
    {
        return $this->resource->connector();
    }

    public function setResource(BaseResource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function resource(): BaseResource
    {
        return $this->resource;
    }

    public function setMethod(Method $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getMethod(): Method
    {
        return $this->method;
    }

    public function setEndpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    public function fillPlaceholders(string $subject): string
    {
        preg_match_all('/\\{(.*?)\\}/', $subject, $matches);

        if (!empty($matches)) {
            list($tags, $keys) = $matches;

            foreach ($keys as $i => $key) {
                $tag = $tags[$i];
                $value = null;

                if ($value === null) {
                    $value = $this->where[$key] ?? null;

                    // If we found something, let's remove it, because most likely it wont be needed anymore
                    if ($value && $this->removeAfterFoundWherePlaceholder) {
                        unset($this->where[$key]);
                    }
                }

                // Look at the attributes
                if ($value === null) {
                    $value = $this->resource()->getAttribute($key) ?? null;
                }

                if (!$value) {
                    throw new Exception("Missing required url param: {$key}, for object: ".get_class($this));
                }

                $subject = str_replace($tag, $value, $subject);
            }
        }

        return $subject;
    }

    public function resolveEndpoint(): string
    {
        return $this->fillPlaceholders($this->endpoint);
    }

    public function applyWhere(PendingRequest $pendingRequest)
    {
        $pendingRequest->query()->merge($this->where);
    }

    public function first(): ?BaseResource
    {
        return $this->get()->first();
    }
}
