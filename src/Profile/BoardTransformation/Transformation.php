<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardTransformation;

use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Prototype\Board as BoardPrototype;
use Aggrego\Domain\Profile\BoardTransformation\Exception\UnprocessableBoardException;

interface Transformation
{
    /**
     * @param Board $board
     * @return BoardPrototype
     * @throws UnprocessableBoardException
     */
    public function transform(Board $board): BoardPrototype;
}
