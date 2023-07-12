<?php

namespace Sxtnmedia\SaloonModelify\Example\Integrations\Github;

use Saloon\Contracts\Request;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Sxtnmedia\SaloonModelify\Traits\HasRequest;

class Github extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    /**
     * The Base URL of the API.
     */
    public function resolveBaseUrl(): string
    {
        return 'https://api.github.com';
    }

    /**
     * Default headers for every request.
     *
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        return [];
    }

    /**
     * Default HTTP client options.
     *
     * @return string[]
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}
