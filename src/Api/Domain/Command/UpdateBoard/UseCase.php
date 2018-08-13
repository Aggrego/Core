<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Domain\Command\UpdateBoard;

use Aggrego\Domain\ProgressiveBoard\Repository;

class UseCase
{
    /** @var Repository */
    private $boardRepository;

    public function __construct(Repository $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    public function handle(Command $command): void
    {
        $board = $this->boardRepository->getBoardByUuid($command->getBoardUuid());

        $board->updateShard(
            $command->getShardUuid(),
            $command->getProfile(),
            $command->getData()
        );
    }
}
