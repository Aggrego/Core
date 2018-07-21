<?php

namespace TimiTao\Construo\Domain\Model\Board\Entity;

use TimiTao\Construo\Domain\Model\Board\ValueObject\Source;

class Shard
{
    /** @var Source */
    private $acceptableSource;

    public function __construct(Source $acceptableSource)
    {
        $this->acceptableSource = $acceptableSource;
    }

    public function getAcceptableSource(): Source
    {
        return $this->acceptableSource;
    }
}
