<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardTransformation;

use Aggrego\Domain\Model\ProgressBoard\ValueObject\Shards;
use Aggrego\Domain\ValueObject\Data;
use Aggrego\Domain\ValueObject\Profile;

interface Transformation
{
    public function isSupported(Profile $profile): bool;

    public function process(Shards $shards): Data;
}
