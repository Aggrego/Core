<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\BoardTransformation;

use TimiTao\Construo\Domain\Model\ProgressBoard\ValueObject\Shards;
use TimiTao\Construo\Domain\ValueObject\Data;

interface Transformation
{
    public function process(Shards $shards): Data;
}
