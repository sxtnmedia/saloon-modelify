<?php

namespace Sxtnmedia\SaloonModelify\Actions;

use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Sxtnmedia\SaloonModelify\BaseRequest;
use Sxtnmedia\SaloonModelify\BaseResource;
use Sxtnmedia\SaloonModelify\Enums\Action;

class FindAction
{
    public function __construct(protected BaseRequest $request)
    {
    }

    public function send($id): ?BaseResource
    {
        $this->prepareRequest($id);
        $response = $this->request->resource()->connector()->send($this->request);

        return $this->transformResponse($response);
    }

    public function transformResponse(Response $response)
    {
        return new ($this->request->resource())($response->json());
    }

    public function prepareRequest($id)
    {
        $this->request
            ->setMethod(Method::GET)
            ->setEndpoint($this->request->resource()->resolveEndpoint(Action::FIND))
            ->where($this->request->resource()->getKeyName(), $id)
        ;
    }
}
