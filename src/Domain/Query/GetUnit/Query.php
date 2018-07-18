<?php

namespace TimiTao\Construo\Domain\Query\GetUnit;

class Query
{
    /** @var array */
    private $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    public function getKey(): array
    {
        return $this->value;
    }
}
