<?php

namespace Sxtnmedia\SaloonModelify;

use Illuminate\Support\Collection;
use Saloon\Contracts\Response;
use Sxtnmedia\SaloonModelify\BaseResource as Resource;

class ResourceCollection extends Collection
{
    protected Resource $resource;
    protected Response $response;

    public function setResponse(Response $response): self
    {
        $this->response = $response;

        return $this;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function setResource(Resource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function getResource(): Resource
    {
        return $this->resource;
    }

    public function getCollection(): self
    {
        return $this;
    }
}
