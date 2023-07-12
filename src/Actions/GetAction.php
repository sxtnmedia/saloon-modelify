<?php

namespace Sxtnmedia\SaloonModelify\Actions;

use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Sxtnmedia\SaloonModelify\BaseRequest;
use Sxtnmedia\SaloonModelify\Enums\Action;
use Sxtnmedia\SaloonModelify\ResourceCollection;
use Sxtnmedia\SaloonModelify\ResponseTransformer;

class GetAction
{
    public function __construct(protected BaseRequest $request)
    {
    }

    public function send(): ?ResourceCollection
    {
        $this->prepareRequest();
        $response = $this->request->resource()->connector()->send($this->request);

        return $this->transformResponse($response);
    }

    public function transformResponse(Response $response)
    {
        $transformer = new ResponseTransformer($this->request->resource());

        return $transformer->transform($response);
    }

    public function prepareRequest()
    {
        $this->request
            ->setMethod(Method::GET)
            ->setEndpoint($this->request->resource()->resolveEndpoint(Action::GET))
        ;
    }
}
