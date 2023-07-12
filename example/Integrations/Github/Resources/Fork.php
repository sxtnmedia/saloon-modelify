<?php

namespace Sxtnmedia\SaloonModelify\Example\Integrations\Github\Resources;

use Sxtnmedia\SaloonModelify\Example\Integrations\Github\Resource;

class Fork extends Resource
{
    public function resolveBaseEndpoint()
    {
        return '/repositories/{repository_id}/forks';
    }

    public function resolveEntityEndpoint()
    {
        return '/repositories/{repository_id}/forks/{id}';
    }

    public function repository()
    {
        return $this->belongsTo(Repository::class, 'parent.id', 'id');
    }
}
