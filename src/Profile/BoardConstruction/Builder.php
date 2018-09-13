<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardConstruction;

use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Prototype\Board as BoardPrototype;
use Aggrego\Domain\Profile\BoardConstruction\Exception\UnableToBuildBoardException;

interface Builder
{
    /**
     * @param Key $key
     * @return BoardPrototype
     * @throws UnableToBuildBoardException
     */
    public function build(Key $key): BoardPrototype;
}
