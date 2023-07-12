<?php

namespace Sxtnmedia\SaloonModelify\Example\Integrations\Github\Resources;

use Sxtnmedia\SaloonModelify\Example\Integrations\Github\Resource;

class Repository extends Resource
{
    public function resolveBaseEndpoint()
    {
        return '/repositories';
    }

    public function forks($repositoryId = null)
    {
        return $this->hasMany(Fork::class, ['repository_id' => $repositoryId ?? $this->id]);
    }
}
