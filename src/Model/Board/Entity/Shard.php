<?php

namespace Aggrego\Domain\Model\Board\Entity;

use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;

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
