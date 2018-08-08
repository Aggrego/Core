<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Application\Profile\BoardTransformation;

use Aggrego\Domain\Api\Application\Profile\BoardTransformation\Exception\UnprocessableBoardException;
use Aggrego\Domain\Model\ProgressiveBoard\Step\State;
use Aggrego\Domain\Model\ProgressiveBoard\Step\Step;

interface Transformation
{
    public function isLastState(State $state): bool;

    /**
     * @param Step $shards
     * @return Step
     * @throws UnprocessableBoardException
     */
    public function process(Step $shards): Step;
}
