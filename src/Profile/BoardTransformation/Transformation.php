<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardTransformation;

use Aggrego\Domain\Profile\BoardTransformation\Exception\UnprocessableBoardException;
use Aggrego\Domain\ProgressiveBoard\Step\Step;

interface Transformation
{
    /**
     * @param Step $shards
     * @return Step
     * @throws UnprocessableBoardException
     */
    public function process(Step $shards): Step;
}
