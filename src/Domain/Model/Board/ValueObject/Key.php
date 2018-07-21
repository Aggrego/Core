<?php

namespace TimiTao\Construo\Domain\Model\Board\ValueObject;

class Key
{
    /** @var array */
    private $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    public function getValue(): array
    {
        return $this->value;
    }
}
