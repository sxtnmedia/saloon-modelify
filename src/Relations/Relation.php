<?php

namespace Sxtnmedia\SaloonModelify\Relations;

use Illuminate\Support\Traits\ForwardsCalls;
use Sxtnmedia\SaloonModelify\BaseResource as Resource;

class Relation
{
    use ForwardsCalls;

    public function __construct(
        public Resource $relatedFrom,
        public Resource|string $relatedTo,
        protected array $attributes = [],
    ) {
        if (is_string($relatedTo)) {
            $this->relatedTo = (new $relatedTo(attributes: $attributes, parent: $relatedFrom));
        }
    }

    public function __call(string $name, array $arguments)
    {
        return $this->forwardCallTo($this->relatedTo, $name, $arguments);
    }

    // public function getRelatedTo()
    // {
    //     return $this->relatedTo;
    // }

    // public function setRelatedTo(Resource $relatedTo): self
    // {
    //     $this->relatedTo = $relatedTo;

    //     return $this;
    // }

    // public function getRelatedFrom()
    // {
    //     return $this->relatedFrom;
    // }

    // public function getObject(): Resource
    // {
    //     return $this->relatedTo;
    // }
}
