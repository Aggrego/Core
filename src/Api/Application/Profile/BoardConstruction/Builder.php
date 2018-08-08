<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Application\Profile\BoardConstruction;

use Aggrego\Domain\Api\Application\Profile\BoardConstruction\Exception\UnableToBuildBoardException;
use Aggrego\Domain\Api\Application\Profile\BoardConstruction\InitialBoardModel\Board;
use Aggrego\Domain\Shared\ValueObject\Key;

interface Builder
{
    /**
     * @param Key $key
     * @return Board
     * @throws UnableToBuildBoardException
     */
    public function build(Key $key): Board;
}
