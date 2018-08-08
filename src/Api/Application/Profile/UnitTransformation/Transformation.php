<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Application\Profile\UnitTransformation;

use Aggrego\Domain\Api\Application\Profile\UnitTransformation\Exception\UnprocessableUnitException;
use Aggrego\Domain\Model\ProgressiveBoard\Step\Step;
use Aggrego\Domain\Shared\ValueObject\Data;

interface Transformation
{
    /**
     * @param Step $shards
     * @return Data
     * @throws UnprocessableUnitException
     */
    public function process(Step $shards): Data;
}
