<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardTransformation;

use Aggrego\Domain\Profile\BoardTransformation\Exception\UnprocessableBoardException;
use Aggrego\Domain\ProgressiveBoard\Step\Step;
use Aggrego\Domain\ProgressiveBoard\Step\Steps\FinalStep;
use Aggrego\Domain\ProgressiveBoard\Step\Steps\ProgressStep;

interface Transformation
{
    /**
     * @param ProgressStep $step
     * @return ProgressStep|FinalStep
     * @throws UnprocessableBoardException
     */
    public function process(ProgressStep $step): Step;
}
