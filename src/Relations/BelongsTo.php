<?php

namespace Sxtnmedia\SaloonModelify\Relations;

use Illuminate\Support\Arr;

class BelongsTo extends Relation
{
    public array $relatedBy = [];

    public function __construct($relatedFrom, $relatedTo, $foreignKey, $localKey)
    {
        $data = [];

        if (is_array($foreignKey)) {
            $this->relatedBy = $foreignKey;
            foreach ($foreignKey as $foreignKey => $localKey) {
                $data[$localKey] = Arr::get($relatedFrom->getAttributes(), $foreignKey);
            }
        } else {
            $this->relatedBy = [$foreignKey => $localKey];
            $data[$localKey] = Arr::get($relatedFrom->getAttributes(), $foreignKey);
        }

        parent::__construct($relatedFrom, $relatedTo, $data);
    }

    public function getRelatedBy()
    {
        return $this->relatedBy;
    }
}
