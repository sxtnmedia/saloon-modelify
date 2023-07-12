<?php

namespace Sxtnmedia\SaloonModelify\Actions;

use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Sxtnmedia\SaloonModelify\BaseRequest;
use Sxtnmedia\SaloonModelify\BaseResource;
use Sxtnmedia\SaloonModelify\Enums\Action;

class DeleteAction
{
    public function __construct(protected BaseRequest $request)
    {
    }

    public function send(array $body): ?BaseResource
    {
        $this->prepareRequest($body);
        $response = $this->request->resource()->connector()->send($this->request);

        if ($response->failed()) {
            return null;
        }

        return $this->transformResponse($response);
    }

    public function transformResponse(Response $response)
    {
        return new ($this->request->resource())($response->json());
    }

    public function prepareRequest($id)
    {
        $this->request
            ->setMethod(Method::DELETE)
            ->setEndpoint($this->request->resource()->resolveEndpoint(Action::DELETE))
            ->where('id', $id)
        ;
    }
}
