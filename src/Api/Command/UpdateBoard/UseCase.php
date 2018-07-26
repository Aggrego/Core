<?php

namespace Aggrego\Domain\Api\Command\UpdateBoard;

use Aggrego\Domain\Model\ProgressBoard\Repository;
use Aggrego\Domain\ValueObject\Data;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;
use Aggrego\Domain\ValueObject\Version;

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
        $board = $this->boardRepository->getBoardByUuid(
            new Uuid($command->getBoardUuid())
        );

        $board->updateShard(
            new Uuid($command->getShardUuid()),
            new Source(
                new Name($command->getSourceName()),
                new Version($command->getVersionName())
            ),
            new Data($command->getData())
        );
    }
}
