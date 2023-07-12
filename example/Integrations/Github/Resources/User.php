<?php

namespace Sxtnmedia\SaloonModelify\Example\Integrations\Github\Resources;

use Sxtnmedia\SaloonModelify\Example\Integrations\Github\Resource;

class User extends Resource
{
    protected string $primaryKey = 'login';

    public function resolveBaseEndpoint()
    {
        return '/users';
    }

    public function resolveEntityEndpoint()
    {
        return '/users/{login}';
    }
}
