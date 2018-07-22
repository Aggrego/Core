<?php

namespace TimiTao\Construo\Domain\Model\ProgressBoard\Entity;

use TimiTao\Construo\Domain\Model\Board\Entity\Shard as BaseShard;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;

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
