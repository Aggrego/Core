<?php

namespace Aggrego\Domain\Model\ProgressBoard\Entity;

use Aggrego\Domain\Model\Board\Entity\Shard as BaseShard;
use Aggrego\Domain\ValueObject\Data;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;

class FinalShard extends BaseShard
{
    /** @var Data */
    private $data;

    public function __construct(Uuid $uuid, Source $acceptableSource, Data $data)
    {
        parent::__construct($uuid, $acceptableSource);
        $this->data = $data;
    }

    public function getData(): Data
    {
        return $this->data;
    }
}
