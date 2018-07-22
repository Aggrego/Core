<?php

namespace TimiTao\Construo\Domain\Model\Board\Entity;

use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;

abstract class Shard
{
    /** @var Uuid */
    private $uuid;

    /** @var Source */
    private $acceptableSource;

    public function __construct(Uuid $uuid, Source $acceptableSource)
    {
        $this->uuid = $uuid;
        $this->acceptableSource = $acceptableSource;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getAcceptableSource(): Source
    {
        return $this->acceptableSource;
    }
}
