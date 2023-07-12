<?php

namespace Sxtnmedia\SaloonModelify\Example\Integrations\Github;

use Sxtnmedia\SaloonModelify\BaseResource;

class Resource extends BaseResource
{
    protected $connector = Github::class;
    protected string $requestClass = Request::class;
}
