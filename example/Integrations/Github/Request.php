<?php

namespace Sxtnmedia\SaloonModelify\Example\Integrations\Github;

use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use Sxtnmedia\SaloonModelify\Actions\CreateAction;
use Sxtnmedia\SaloonModelify\Actions\DeleteAction;
use Sxtnmedia\SaloonModelify\Actions\FindAction;
use Sxtnmedia\SaloonModelify\Actions\GetAction;
use Sxtnmedia\SaloonModelify\Actions\UpdateAction;
use Sxtnmedia\SaloonModelify\BaseRequest;
use Sxtnmedia\SaloonModelify\BaseResource;
use Sxtnmedia\SaloonModelify\ResourceCollection;

class Request extends BaseRequest implements HasBody
{
    use HasJsonBody;

    public function find($id): ?BaseResource
    {
        return (new FindAction($this))->send($id);
    }

    public function create($body)
    {
        return (new CreateAction($this))->send($body);
    }

    public function delete($id)
    {
        return (new DeleteAction($this))->send($id);
    }

    public function update($body)
    {
        return (new UpdateAction($this))->send($body);
    }

    public function get(): ResourceCollection
    {
        return (new GetAction($this))->send();
    }
}
