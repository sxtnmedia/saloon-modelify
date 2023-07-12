<?php

namespace Sxtnmedia\SaloonModelify;

use Saloon\Contracts\Response;

class ResponseTransformer
{
    protected BaseResource $resource;

    public function __construct(BaseResource $resource)
    {
        $this->resource = $resource;
    }

    public function transform(Response $response): mixed
    {
        $data = $response->json();

        foreach ($data as &$item) {
            $item = new ($this->resource)($item);
        }

        $collection = new ResourceCollection($data);
        $collection->setResponse($response);
        $collection->setResource($this->resource);

        return $collection;
    }
}
